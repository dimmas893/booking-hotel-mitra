<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginMitraController extends Controller
{
    public function login(LoginRequest $request)
    {
        // dd($request->all());
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        } else {
            return back()->with('loginsalah', 'p');
        }
    }

    public function viewadmin()
    {
        return view('auth.loginadmin');
    }

    public function loginadmin(LoginRequest $request)
    {
        // dd($request->all());
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        } else {
            return back()->with('loginsalah', 'p');
        }
    }

    public function view()
    {
        return view('auth.loginmitra');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('loginaplikasimitraview');
    }
}
