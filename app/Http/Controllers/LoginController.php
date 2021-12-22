<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('pages.login', [
            'title' => 'Login - Laramerce'
        ]);
    }

    public function auth(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->roles == 'user') {
                return redirect()->intended('/home');
            } else {
                return redirect()->intended('/dashboard');
            }
        }

        return redirect()->back()->with('warning', 'Email or password does not match with our records!')->withInput();
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect('/');
    }
}
