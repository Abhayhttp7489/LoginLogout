<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Show login form
    public function login()
    {
        // Redirect to dashboard if user is already authenticated
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    // Handle login form submission
    public function loginPost(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    // Show register form
    public function register()
    {
        // Redirect to dashboard if user is already authenticated
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.register');
    }

    // Handle register form submission
    public function registerPost(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed', // Ensure passwords match
        ]);

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Redirect to login after successful registration
        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }

    // Show logout confirmation page
    public function logout()
    {
        return view('auth.logout');
    }

    // Handle logout functionality
    public function logoutPost()
    {
        Auth::logout();
        return redirect()->route('login'); // Redirect to the login page after logout
    }

    // Handle profile update
    public function updateProfile(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
        ]);

        // Update user profile
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Profile updated successfully.');
    }

    // Show edit profile form
    public function editProfile()
    {
        return view('edit-profile'); // Ensure this view file exists in the views folder
    }
}
