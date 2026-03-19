<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\WalletAccount;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Create Order
    public function create(Request $request)
    {
        $request->validate([
            'amount'=>'required|numeric|min:1',
            'brand_id'=>'nullable|numeric'
        ]);

        $user = $request->user();
        $wallet = $user->walletAccount;

        if($wallet->balance < $request->amount){
            return response()->json(['message'=>'Insufficient wallet balance'], 400);
        }

        DB::transaction(function() use ($user, $wallet, $request){
            $wallet->balance -= $request->amount;
            $wallet->save();

            WalletTransaction::create([
                'user_id'=>$user->id,
                'amount'=>$request->amount,
                'type'=>'order',
                'reference_id'=>null
            ]);

            Order::create([
                'user_id'=>$user->id,
                'brand_id'=>$request->brand_id ?? null,
                'amount'=>$request->amount,
                'status'=>'pending'
            ]);
        });

        return response()->json(['message'=>'Order created successfully','balance'=>$wallet->balance]);
    }

    // List Orders
    public function index(Request $request)
    {
        $orders = Order::where('user_id',$request->user()->id)->get();
        return response()->json($orders);
    }

    // Get Order By ID
    public function show(Request $request, $id)
    {
        $order = Order::where('user_id',$request->user()->id)->where('id',$id)->first();
        if(!$order){
            return response()->json(['message'=>'Order not found'],404);
        }
        return response()->json($order);
    }
}