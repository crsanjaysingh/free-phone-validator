<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class UserWalletController extends Controller
{
  public function showWalletHistory(Request $request, $userId = null)
  {
    if (!$userId && Auth::user()->hasRole("user")) {
      $userId = Auth::id();
    }
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

    return view('user.wallet.history', compact(var_name: 'wallet'));
  }
}
