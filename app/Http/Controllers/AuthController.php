<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\WalletAccount;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Registration
    public function register(Request $request)
    {
        $request->validate([
            'name'=>'required|string',
            'email'=>'required|email|unique:users',
            'password'=>'required|string|min:6'
        ]);

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);

        // Create Wallet for user
        WalletAccount::create([
            'user_id'=>$user->id,
            'balance'=>0
        ]);

        return response()->json(['message'=>'User registered successfully','user'=>$user]);
    }

    // Login
    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|string'
        ]);

        if(!Auth::attempt($request->only('email','password'))){
            return response()->json(['message'=>'Invalid credentials'],401);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message'=>'Login successful',
            'access_token'=>$token,
            'token_type'=>'Bearer'
        ]);
    }

    // Get logged-in user
    public function me(Request $request)
    {
        $user = $request->user();
        $wallet = $user->walletAccount;

        return response()->json([
            'user'=>$user,
            'wallet'=>$wallet
        ]);
    }
}