<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function create() {
        return view('auth/signup');    
    }
    public function signUp(Request $request) {
        $request->validate([
            'name' => 'required',
            //'email'=> 'required|email|unique:App\Models\Users',
            'email'=> 'required|email',
            'password'=> 'required|min:6'
        ]);
        $user = User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
            'role'=>'reader',
        ]);
        $user->createToken('newtoken')->plainTextToken;

        return redirect()->route('signin');
    }
    public function auth(Request $request) {
        return view('auth/signin');
    }
    public function signIn(Request $request) {
        $credentials = $request->validate([
            'email'=> 'required|email',
            'password'=> 'required|min:6'
        ]);

        if (Auth::attempt($credentials, $request->remember)){
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return back()->withErrors([
            'email' => 'Данный логин или пароль неверный',
        ]);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
