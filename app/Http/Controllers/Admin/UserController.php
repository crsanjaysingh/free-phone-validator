<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $users = User::query();
      return DataTables::of($users)
        ->addColumn('action', function ($row) {
          $blockButton = $row->is_blocked
            ? '<button id="block_user_' . $row->id . '" class="btn btn-sm btn-warning" data-user_id="' . $row->id . '" data-block_url="' . route('admin.users.block', ['userId' => $row->id]) . '">Unblock</button> '
            : '<button id="block_user_' . $row->id . '" class="btn btn-sm btn-danger" data-user_id="' . $row->id . '" data-block_url="' . route('admin.users.block', ['userId' => $row->id]) . '">Block</button> ';

          return
            '<button id="add_amount_' . $row->id . '" class="btn btn-sm btn-success" data-user_id="' . $row->id . '">Add Amount</button> '
            . $blockButton
            . '<a href="' . route('admin.wallet.history', ['userId' => $row->id]) . '" class="btn btn-sm btn-primary">Wallet Transactions</a>';
        })
        ->make(true);
    }
    return view('admin.users.index');
  }

  public function block(Request $request, $userId)
  {
    try {
      if (!empty($request->user_id)) {
        $user = User::find($userId);

        if ($user) {

          $user->is_blocked = !$user->is_blocked;
          $user->save();

          $message = $user->is_blocked ? 'User blocked successfully.' : 'User unblocked successfully.';
          return response()->json(['success' => true, 'message' => $message, 'is_blocked' => $user->is_blocked]);
        }

        return response()->json(['success' => false, 'message' => 'User not found.']);
      } else {
        return response()->json(['success' => false, 'message' => 'Invalid User Id']);
      }
    } catch (\Exception $e) {
      Log::error('Error blocking/unblocking user: ' . $e->getMessage(), [
        'userId' => $userId,
        'error' => $e->getTraceAsString(),
      ]);

      return response()->json(['success' => false, 'message' => 'An error occurred while processing the request.']);
    }
  }
}
