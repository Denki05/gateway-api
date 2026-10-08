<?php

namespace App\Http\Controllers;

use App\Support\GatewaySettings;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginForm()
    {
        if (session()->get('gw_admin')) {
            return redirect('/');
        }
        return view('gateway.login');
    }

    public function login(Request $request)
    {
        $request->validate(['username' => 'required', 'password' => 'required']);
        $cfg = GatewaySettings::all();
        if ($request->username === $cfg['ADMIN_USER'] && $request->password === $cfg['ADMIN_PASS']) {
            session()->put('gw_admin', $request->username);
            return redirect('/');
        }
        return back()->withErrors(['login' => 'Username atau password salah.'])->withInput();
    }

    public function logout()
    {
        session()->forget('gw_admin');
        return redirect('/login');
    }
}
