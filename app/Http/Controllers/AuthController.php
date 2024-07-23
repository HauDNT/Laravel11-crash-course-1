<?php

namespace App\Http\Controllers;

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

        // Redirect
        return redirect()->route('home');
    }
}
