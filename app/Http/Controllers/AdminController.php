<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

//use PhpParser\Node\Stmt\Return_;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showLogin()
    {
        return view('admin.auth.login');
    }
    public function ShowRegister()
    {
        return view('admin.auth.register');
    }


    public function login(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        $credentials = $request->only('user_name', 'password');
        // dd($credentials); // Debugging line

        if ((Auth()->guard('admin')->attempt($credentials))) {

            // Authentication passed, redirect to admin dashboard
            return redirect()->intended(route('adminSittings'));
            // return view('layouts.admin');

        }

        // Authentication failed, redirect back with an error
        return redirect()->back()->withErrors(['user_name' => 'بيانات غير متتطابقه .']);
    }
    public function register(Request $request)
{
    // Step 1: Validate the incoming request
    $validator = Validator::make($request->all(), [
        'email'      => 'required|email|unique:admins,email',
        'name'       => 'required|string|max:255',
        'user_name'  => 'required|string|max:255|unique:admins,user_name',
        'password'   => 'required|string|min:8|confirmed',  // The password needs to be confirmed (matching `password_confirmation`)
        'added_by'   => 'nullable|integer',
        'updated_by' => 'nullable|integer',
        'active'     => 'required|boolean',
        'date'       => 'required|date',
        'com_code'   => 'required|string|max:255',
    ]);

    // Step 2: Handle validation failure
    if ($validator->fails()) {
        Log::info('Validation failed', $validator->errors()->toArray());  // Log the validation errors
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    // Step 3: Create and save the admin
    try {
        // No need to hash password manually; the model accessor will handle it
        $admin = [
            'email' => $request->email,
            'name' => $request->name,
            'user_name' => $request->user_name,
            'password' => $request->password, // This will be hashed by the setPasswordAttribute accessor
            'added_by' => $request->added_by ?? auth()->id(), // Default to the current authenticated user
            'updated_by' => $request->added_by ?? 1, // Default to the current authenticated user
            'active' => $request->active,
            'date' => Carbon::parse($request->date),
            'com_code' => $request->com_code,
        ];

        // Step 4: Save the admin
        Admin::create($admin);

        // Step 5: Return success message
        return redirect()->route('admin.dashboard')->with('success', 'Admin registered successfully.');
    } catch (\Exception $e) {
        // Step 6: Handle exceptions
        Log::error('Error saving admin: ' . $e->getMessage());  // Log the exception for debugging
        return redirect()->route('admin.dashboard')->with('error', 'Failed to register admin. Please try again.');
    }
}


    public function logout()
    {

        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }



    public function dashboard()
    {
        return view('layouts.admin');
    }
}
