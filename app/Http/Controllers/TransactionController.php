<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use App\Models\DetailTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class TransactionController extends Controller
{
    public function process(Request $request)
    {
        //ambil data user
        $user = Auth::user();
        $user->update($request->except('total'));

        //proses checkout
        $code = 'STORE-' . mt_rand(0000, 9999);
        $carts = Cart::with(['product', 'user'])->where('users_id', Auth::user()->id)->get();

        //transaction create
        $transaction = Transaction::create([
            'users_id' => Auth::user()->id,
            'insurance_price' => 0,
            'shipping_cost' => 0,
            'total' => $request->total,
            'transaction_status' => 'PENDING',
            'code' => $code
        ]);

        foreach ($carts as $cart) {
            $trx = "TRX-" . mt_rand(0000, 9999);
            DetailTransaction::create([
                'transactions_id' => $transaction->id,
                'products_id' => $cart->product->id,
                'price' => $cart->product->price,
                'transaction_status' => 'PENDING',
                'receipt' => '',
                'code' => $trx
            ]);
        }

        //hapus isi cart
        Cart::where('users_id', Auth::user()->id)->delete();

        return dd($transaction);
    }
}
