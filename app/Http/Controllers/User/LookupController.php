<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ApiResponse as Lookup;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class LookupController extends Controller
{

  public function index(Request $request)
  {

    if ($request->ajax()) {

      $userId = Auth::id();
      $lookups = Lookup::with('user')
        ->where('user_id', $userId)
        ->orderBy('created_at', 'desc');

      return DataTables::of($lookups)
        ->addColumn('action', function ($row) {
          return '<button id="lookup_id_' . $row->id . '" class="btn btn-sm btn-info show-lookup-details" data-lookup-id="' . $row->id . '">Details</button>';
        })
        ->editColumn('created_at', function ($lookup) {
          return $lookup->created_at->format('m-d-Y H:i:s');
        })
        ->addColumn('user', function ($lookup) {
          return $lookup->user->name ?? 'N/A';
        })
        ->make(true);
    }

    return view('user.lookup.index');
  }

  public function getData(Request $request)
  {
    if ($request->ajax()) {
      $lookups = Lookup::with('user')
        ->orderBy('created_at', 'desc');
      return DataTables::of($lookups)
        ->addColumn('action', function ($row) {
          return '<button id="lookup_id_' . $row->id . '" class="btn btn-sm btn-info show-lookup-details" data-lookup-id="' . $row->id . '">Details</button>';
        })
        ->editColumn('created_at', function ($lookup) {
          return $lookup->created_at->format('m-d-Y H:i:s');
        })
        ->addColumn('user', function ($lookup) {
          return $lookup->user->name ?? 'N/A';
        })
        ->make(true);
    }
  }
}