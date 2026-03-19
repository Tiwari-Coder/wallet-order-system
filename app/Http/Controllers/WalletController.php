<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WalletAccount;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    // Balance
    public function balance(Request $request)
    {
        $wallet = $request->user()->walletAccount;
        return response()->json([
            'user_id'=>$request->user()->id,
            'balance'=>$wallet->balance
        ]);
    }

    // Transactions 
    public function transactions(Request $request)
    {
        $transactions = WalletTransaction::where('user_id',$request->user()->id)->get();
        return response()->json($transactions);
    }

    // Deposit 
    public function deposit(Request $request)
    {
        $request->validate([
            'amount'=>'required|numeric|min:1'
        ]);

        $user = $request->user();
        $wallet = $user->walletAccount;

        DB::transaction(function() use ($user, $wallet, $request){
            $wallet->balance += $request->amount;
            $wallet->save();

            WalletTransaction::create([
                'user_id'=>$user->id,
                'amount'=>$request->amount,
                'type'=>'deposit'
            ]);
        });

        return response()->json([
            'message'=>'Deposit successful',
            'balance'=>$wallet->balance
        ]);
    }
}