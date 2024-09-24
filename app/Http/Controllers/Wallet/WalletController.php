<?php

namespace App\Http\Controllers\Wallet;

use Exception;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;


class WalletController extends Controller
{
  public function addFunds(Request $request)
  {
    $request->validate([
      'amount' => 'required|numeric|min:0.01',
      'user_id' => 'required|exists:users,id',
      'memo' => 'required|string|max:255',
    ]);

    try {
      DB::beginTransaction();

      $userId = $request->user_id;
      $user = User::findOrFail($userId);

      $wallet = $user->wallet ?? Wallet::create(['user_id' => $user->id]);
      $wallet->balance += $request->amount;
      $wallet->save();

      WalletTransaction::create([
        'wallet_id' => $wallet->id,
        'amount' => $request->amount,
        'added_by' => Auth::user()->id,
        'memo' => $request->memo,
      ]);

      DB::commit();

      return redirect()->back()->with('success', 'Funds added successfully!');
    } catch (Exception $e) {
      DB::rollBack();
      Log::error('Failed to add funds: ' . $e->getMessage());
      return redirect()->back()->withErrors('An error occurred while adding funds. Please try again.' + $e->getMessage());
    }
  }

  public function updateFunds(Request $request)
  {

    $request->validate([
      'amount' => 'required|numeric|min:0.01',
      'transaction_id' => 'required|exists:wallet_transactions,id',
      'wallet_id' => 'required|exists:wallets,id',
      'memo' => 'required|string|max:255',
    ]);

    try {
      DB::beginTransaction();

      $wallet = Wallet::findOrFail($request->wallet_id);
      $wallet->balance -= $request->old_amount;
      $wallet->balance += $request->amount;
      $wallet->save();

      $walletTransaction = WalletTransaction::findOrFail($request->transaction_id);
      $walletTransaction->amount = $request->amount;
      $walletTransaction->memo = $request->memo;
      $walletTransaction->save();

      DB::commit();
      return redirect()->back()->with('success', 'Funds updated successfully!');
    } catch (Exception $e) {
      DB::rollBack();
      Log::error('Failed to add funds: ' . $e->getMessage());
      return redirect()->back()->withErrors('An error occurred while updating funds. Please try again.' + $e->getMessage());
    }
  }

  public function showWalletHistory(Request $request, $userId = null)
  {
    if ($request->ajax()) {
      if ($userId) {
        $user = User::findOrFail($userId);
        $wallet = $user->wallet;
        $transactions = $wallet->transactions()->orderBy('created_at', 'desc');
      } else {
        $transactions = WalletTransaction::with('wallet.user')->orderBy('created_at', 'desc');
      }
      return DataTables::of($transactions)
        ->addColumn('action', function ($row) {
          $rowData = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');
          return '<button id="transaction_id_' . $row->id . '" class="btn btn-sm btn-success" data-array=\'' . $rowData . '\'>Update</button>';
        })
        ->editColumn('created_at', function ($transaction) {
          return $transaction->created_at->format('m-d-Y H:i:s');
        })
        ->addColumn('user', function ($transaction) {
          return $transaction->wallet->user->name ?? 'N/A';
        })
        ->addColumn('added_by', function ($transaction) {
          return $transaction->addedByUser->name ?? 'N/A';
        })
        ->editColumn('memo', function ($transaction) {
          return strlen($transaction->memo) > 20
            ? substr($transaction->memo, 0, 20) . '...'
            : $transaction->memo;
        })
        ->make(true);
    }

    $wallet = null;
    if ($userId) {
      $user = User::findOrFail($userId);
      $wallet = $user->wallet;
    }

    return view('admin.wallet.history', compact(var_name: 'wallet'));
  }
}
