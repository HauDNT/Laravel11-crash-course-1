<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Register user
    public function register(Request $request) {
        // Validate
        $fields = $request->validate([
            'username' => ['required', 'max:255'],
            'email' => ['required', 'max:255', 'email', 'unique:users'],
            'password' => ['required', 'min:3', 'confirmed']
        ]);

        // Register
        $user = User::create($fields);

        // Login
        Auth::login($user);

        event(new Registered($user));

        // Redirect
        return redirect()->intended("dashboard");
    }

    public function login(Request $request) {
        // Validate
        $fields = $request->validate([
            'email' => ['required', 'max:255', 'email'],
            'password' => ['required']
        ]);

        // Try to login:
        if (Auth::attempt($fields, $request->remember)) {
            return redirect()->intended("dashboard");
        }
        else {
            return back()->withErrors([
                'failed' => 'The provided credentials do not match our records!'
            ]);
        };
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect("/");
    }
}
