<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function Authenticate(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        };
        return back()->withErrors(['email' => 'These credentials do not match our records.']);
    }
    public function dashboard()
    {
        return view('dashboard');
    }

    public function register(RegisterRequest $request)
    {
        User::create($request->validated());
        return redirect()->back()->with('success', 'register complete');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
