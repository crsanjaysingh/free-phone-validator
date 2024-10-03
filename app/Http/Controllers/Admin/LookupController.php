<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lookup_history as Lookup;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LookupController extends Controller
{
  public function index(Request $request)
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
    return view('admin.lookup.index');
  }

  public function getData(Request $request)
  {
    if ($request->ajax()) {
      $lookups = Lookup::with('user')  // Assuming 'user' relationship is defined in the model
        ->orderBy('created_at', 'desc');

      return DataTables::of($lookups)
        ->addColumn('action', function ($row) {
          return '<button id="lookup_id_' . $row->id . '" class="btn btn-sm btn-info show-lookup-details" data-lookup-id="' . $row->id . '">Details</button>';
        })
        ->editColumn('created_at', function ($lookup) {
          return $lookup->created_at->format('m-d-Y H:i:s');
        })
        ->addColumn('user', function ($lookup) {
          return $lookup->user->name ?? 'N/A';  // Display the user name
        })
        ->make(true);
    }
  }
}
