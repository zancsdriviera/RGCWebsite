<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $admin = Login::where('email', $request->email)->first();
    if($admin && password_verify($request->password, $admin->password)){
        Session::put('admin', true);
        return redirect()->route('admin.home'); // ✅ Default page after login
    }

    return back()->withErrors(['Invalid credentials']);
}


    public function logout()
    {
        Session::forget('admin');
        return redirect()->route('admin.index');
    }
}
