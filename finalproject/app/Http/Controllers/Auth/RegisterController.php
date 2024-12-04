<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Show the application registration form
     * 
     * @return \Illuminate\View\View Returns the registration form view
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application
     * 
     * @param  \Illuminate\Http\Request  $request The incoming registration request with user data
     * @return \Illuminate\Http\RedirectResponse
     * 
     * @throws \Illuminate\Validation\ValidationException When validation fails
     */
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string'],
            'address' => ['required', 'string'],
            'country' => ['required', 'string'],
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'country' => $request->country,
            'role' => 'friend', // Default role for registration
        ]);

        Auth::login($user);

        return redirect()->route('friend.dashboard');
    }
}
