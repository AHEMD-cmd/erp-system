<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;

class LoginContoller extends Controller
{
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    public function login(LoginRequest $request)
    {
        if (auth()->guard('admin')->attempt([
            'username' => $request->input('username'),
            'password' => $request->input('password')
        ])) {
            // Redirect to the intended URL or the admin dashboard
            return redirect()->intended(route('admin.dashboard'));
        } else {
            return redirect()->route('admin.login')->with([
                'error' => 'عفوا بيانات تسجيل الدخول غير صحيحة !!'
            ]);
        }
    }


    public function logout()
    {
        auth()->logout();
        return redirect()->route('admin.login');
    }
}
