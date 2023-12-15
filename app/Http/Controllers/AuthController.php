<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email|sanitize:email',
            'password' => 'required|sanitize:escape',

        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'message' => 'Invalid email or password.',
        ]);
    }

    public function register(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        User::create($credentials);

        auth()->login(User::where('email', $credentials['email'])->first());

        $request->session()->regenerate();
        return redirect()->intended('/');
    }
}
