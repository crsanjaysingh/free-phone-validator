<?php

namespace App\Http\Controllers\User;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use App\Models\User;


class ProfileController extends Controller
{
  public function index()
  {
    $user = User::where('id', Auth::id())
      ->first();
    return view(view: 'user.profile.index', data: ['user' => $user]);
  }
  public function store(Request $request)
  {

    $validator = Validator::make($request->all(), [
      'firstName' => 'required|string|max:255',
      'lastName' => 'string|max:255',
      'email' => 'required|email|unique:profiles|max:255',
      'phoneNumber' => 'nullable|string|max:15',
      'upload' => 'nullable|image|mimes:jpeg,png,jpg|max:800', // Max size 800KB
    ]);

    if ($validator->fails()) {
      return response()->json(['errors' => $validator->errors()], 422);
    }

    $user = Auth::user();

    if ($request->hasFile('upload')) {
      $result = imageUpload($request->file('upload'), 'profiles');
      if ($result['status']) {
        $oldImagePath = $user->profile_image;
        if (File::exists(public_path('storage/' . $oldImagePath))) {
          File::delete(public_path('storage/' . $oldImagePath));
        }
        $filePath = $result['file_path'];
      } else {
        return response()->json(['status' => false, 'message' => $result['message']], 422);
      }
    } else {
      $filePath = $user->profile_image;
    }

    // Update user profile data
    $user->name = $request->firstName;
    $user->last_name = $request->lastName;
    $user->email = $request->email;
    $user->phone_number = $request->phoneNumber;
    $user->profile_image = $filePath;
    $data = [
      'profile_image' => $user->profile_image,
    ];

    // Save the updated user information
    $user->save();
    return response()->json(['status' => 'success', 'message' => 'Profile updated successfully!', 'data' => $data]);
  }

  /**
   * Delete the user's account.
   */
  public function destroy(Request $request): RedirectResponse
  {
    $request->validateWithBag('userDeletion', [
      'password' => ['required', 'current_password'],
    ]);

    $user = $request->user();

    Auth::logout();

    $user->delete();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return Redirect::to('/');
  }
}
