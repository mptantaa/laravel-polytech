<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function create() {
        // return view('auth/signup');    
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
        $token = $user->createToken('newtoken')->plainTextToken;

        return response()->json(['user'=>$user, 'token'=>$token]);
    }
    public function auth(Request $request) {
        // return view('auth/signin');
    }
    public function signIn(Request $request) {
        $credentials = $request->validate([
            'email'=> 'required|email',
            'password'=> 'required|min:6'
        ]);

        if (Auth::attempt($credentials, $request->remember)){
            $token = auth()->user()->createToken('MyAppTokens')->plainTextToken;
            return response()->json(['user'=>auth()->user(), 'token'=>$token]);
        }
        return response([
            'email' => 'Данный логин или пароль неверный',
        ], 400);
    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();
        return response('Logout', 201);
    }
}
