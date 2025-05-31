<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    function index() {
        if ($user = Auth::user()) {
            if ($user->level == 'admin') {
                return redirect('admin/user');
            }
            if ($user->level == 'kasir') {
                return redirect('admin/order');
            }
            if ($user->level == 'manager') {
                return redirect('admin/kategori');
            }
        }
        return view('Backend.login');
    }
    function postlogin(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:3'
        ]);
        $data = $request->only('email', 'password');
        if (Auth::attempt($data)){
            $user = Auth::user();
            if ($user->level == 'admin') {
                return redirect('admin/user');
            }if ($user->level == 'kasir') {
                return redirect('admin/order');
            }if ($user->level == 'manager') {
                return redirect('admin/kategori');
            }
        }
        return redirect('admin');
    }
    function logout() {
        session()->flush();
        Auth::logout();
        return redirect('admin');
    }
}