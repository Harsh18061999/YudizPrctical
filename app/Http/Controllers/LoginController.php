<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);
        
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            if($user->role == '1'){ //admin user
                return redirect()->route('products.index');
            }else{
                return redirect()->route('dashboard');
            }
        }else{
           return redirect()->back()->with(['error' => 'Invalid Email Or Password.']);
        }
    }

    public function logout(Request $request){
        Auth::logout();
        return view('login');
    }
}
