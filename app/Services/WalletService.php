<?php

namespace App\Services;

use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Collator;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PHPUnit\TestRunner\TestResult\Collector;

class WalletService
{
  /**
   * Add funds to the user's wallet.
   *
   * @param int $userId
   * @param float $amount
   * @param string $memo
   * @return bool
   */
  public function addFunds(int $userId, float $amount, string $memo)
  {
    try {
      DB::beginTransaction();

      $user = User::findOrFail($userId);

      $wallet = $user->wallet ?? Wallet::create(['user_id' => $user->id]);
      $wallet->balance += $amount;
      $wallet->save();

      WalletTransaction::create([
        'wallet_id' => $wallet->id,
        'amount' => $amount,
        'added_by' => Auth::user()->id,
        'memo' => $memo ?? "Amount Added",
      ]);

      DB::commit();
      return true;
    } catch (Exception $e) {
      DB::rollBack();
      Log::error('Failed to add funds: ' . $e->getMessage());
      return false;
    }
  }

  /**
   * Update the funds in the wallet for admin use only.
   *
   * @param int $transactionId
   * @param int $walletId
   * @param float $newAmount
   * @param float $oldAmount
   * @param string $memo
   * @return bool
   */
  public function updateFunds(int $transactionId, int $walletId, float $newAmount, float $oldAmount, string $memo)
  {
    try {
      DB::beginTransaction();

      $wallet = Wallet::findOrFail($walletId);
      $wallet->balance -= $oldAmount;
      $wallet->balance += $newAmount;
      $wallet->save();

      $walletTransaction = WalletTransaction::findOrFail($transactionId);
      $walletTransaction->amount = $newAmount;
      $walletTransaction->memo = $memo ?? "Amount Added";
      $walletTransaction->save();

      DB::commit();
      return true;
    } catch (Exception $e) {
      DB::rollBack();
      Log::error('Failed to update funds: ' . $e->getMessage());
      return false;
    }
  }

  /**
   * Handle purchasing logic and reduce the wallet balance accordingly.
   *
   * @param Collection $user
   * @param float $amount
   * @param string $itemDescription
   * @return bool|string
   */
  public function buyItem($user = null, float $amount, string $itemDescription)
  {
    try {
      DB::beginTransaction();

      $user = empty($user) ? User::findOrFail(Auth::id()) : $user;

      $wallet = $user->wallet;

      if (!$wallet || $wallet->balance < $amount) {
        return 'Insufficient funds';
      }

      $wallet->balance -= $amount;
      $wallet->save();

      WalletTransaction::create([
        'wallet_id' => $wallet->id,
        'amount' => $amount,
        'added_by' => $user->id,
        'memo' => 'Purchased: ' . $itemDescription,
      ]);

      DB::commit();
      return true;
    } catch (Exception $e) {
      DB::rollBack();
      Log::error('Failed to process purchase: ' . $e->getMessage());
      return false;
    }
  }
}
