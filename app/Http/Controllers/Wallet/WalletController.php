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
use App\Services\WalletService;
use Yajra\DataTables\Facades\DataTables;


class WalletController extends Controller
{
  protected $walletService;

  public function __construct(WalletService $walletService)
  {
    $this->walletService = $walletService;
  }
  public function addFunds(Request $request)
  {
    $request->validate([
      'amount' => 'required|numeric|min:0.01',
      'user_id' => 'required|exists:users,id',
      'memo' => 'required|string|max:255',
    ]);

    $result = $this->walletService->addFunds($request->user_id, $request->amount, $request->memo);

    if ($result) {
      return redirect()->back()->with('success', 'Funds added successfully!');
    } else {
      return redirect()->back()->withErrors('An error occurred while adding funds.');
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

    $result = $this->walletService->updateFunds($request->transaction_id, $request->wallet_id, $request->amount, $request->old_amount, $request->memo);

    if ($result) {
      return redirect()->back()->with('success', 'Funds updated successfully!');
    } else {
      return redirect()->back()->withErrors('An error occurred while updating funds.');
    }
  }

  public function buyItem(Request $request)
  {
    $request->validate([
      'amount' => 'required|numeric|min:0.01',
      'item' => 'required|string|max:255',
    ]);

    $result = $this->walletService->buyItem(Auth::id(), $request->amount, $request->item);

    if ($result === true) {
      return redirect()->back()->with('success', 'Purchase successful!');
    } elseif ($result === 'Insufficient funds') {
      return redirect()->back()->withErrors('Insufficient funds.');
    } else {
      return redirect()->back()->withErrors('An error occurred during the purchase.');
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
