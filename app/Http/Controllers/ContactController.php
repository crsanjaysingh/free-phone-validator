<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactModel;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Exceptions;
use Illuminate\Support\Facades\Log;
class ContactController extends Controller
{
    public function index(){
        return view('frontend.contact');
    }

    public function contact(Request $request)
    {
        try {
            // Validate the incoming request data
            $validated = $request->validate([
                'fullName' => 'required|string|max:255',
                'contactEmail' => 'required|email|max:255',
                'contactSubject' => 'required|not_in:Select',
                'contactDescription' => 'required|string|max:500|min:5',
            ]);

        
            print_r("Before Validation");
            // Create a new Contact entry in the database
            ContactModel::create([
                'full_name' => $validated['fullName'],
                'email' => $validated['contactEmail'],
                'subject' => $validated['contactSubject'],
                'description' => $validated['contactDescription'],
            ]);
            print_r("After Validation");
            // Return a success response
            return response()->json([
                'message' => 'Contact form submitted successfully.',
                'data' => $validated
            ], 200);
            
        } catch (ValidationException $e) {
            Log::error('Validation Error: ' . json_encode($e->errors()));
            return response()->json([
                'errors' => $e->errors()
            ], 422);
            
        } catch (\Exception $e) {
            // Log and return a generic error message
            Log::error('Error occurred: ' . $e->getMessage());
            return response()->json([
                'message' => 'An error occurred. Please try again later.',
                'error' => $e->getMessage() // Optionally include the error message
            ], 500);
        }
    }
}
