<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login_view()
    {
        if (Auth::guard('web')->user()) {
            return redirect('/home');
        }

        return view('web.auth.login');
    }

    public function login(Request $request)
    {
        if (Auth::guard('web')->attempt([
            'email' => $request->email,
            'password' => $request->password,
//            'active' => 1,
        ])) {
            return redirect(route('web.home'));
        } else {
            session()->flash('error', 'Invalid Email or password!');
            return back();
        }
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
