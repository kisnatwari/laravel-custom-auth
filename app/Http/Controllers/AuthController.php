<?php

namespace App\Http\Controllers;

use App\Mail\OTPSender;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',

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
            'name' => 'required|string|max:255|regex:/^(?![0-9])[A-Za-z\s]+$/',
            'email' => 'required|email|unique:users|regex:/^[a-zA-Z][_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z][_a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,})$/',
            'password' => 'required|confirmed|min:8|max:20',
        ]);

        $credentials['otp'] = $this->sendOTP($credentials['email']);
        $credentials['otp_expired_at'] = date('Y-m-d H:i:s', time() + (5 * 60));
        $credentials['password'] = bcrypt($credentials['password']);

        User::create($credentials);

        Auth::login(User::where('email', $credentials['email'])->first());

        $request->session()->regenerate();
        return redirect('/verify');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function authEmailVerify()
    {
        $user = Auth::user();
        if (!$user)
            return redirect()->route('login');

        $OTP = $this->sendOTP($user['email']);

        $user->otp = $OTP;
        $user->otp_expired_at = date('Y-m-d H:i:s', time() + (5 * 60));
        $user->save();

        return redirect('/verify');
    }


    public function sendOTP($email)
    {
        $OTP = rand(100000, 999999);
        $mailData = ['email' => $email, 'OTP' => $OTP];
        Mail::to($email)->send(new OTPSender($mailData));
        return $OTP;
    }

    public function verifyOTP(Request $request)
    {
        $request->validate([
            'verification_code' => 'required|numeric'
        ]);
        if (!Auth::check())
            return back()->withErrors([
                'message' => 'Please login first...',
            ]);

        $user = Auth::user(); // Get the authenticated user
        if ($user->otp === $request->verification_code) {
            $user->email_verified_at = now();
            $user->save();
            return redirect('/')->with('success', 'Email verified successfully');
        } else {
            return back()->withErrors([
                'message' => 'Invalid OTP. Please try again.',
            ]);
        }
    }
}
