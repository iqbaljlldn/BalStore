<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\DetailTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardTransactionsController extends Controller
{
    public function index() {
        $sellTransactions = DetailTransaction::with(['transaction.user', 'product.galleries'])
        ->whereHas('product', function($product) {
            $product->where('users_id', Auth::user()->id);
        })->get();
        $buyTransactions = DetailTransaction::with(['transaction.user', 'product.galleries'])
        ->whereHas('transaction', function($transaction) {
            $transaction->where('users_id', Auth::user()->id);
        })->get();

        return view('pages.dashboard-transactions', compact('sellTransactions', 'buyTransactions'));
    }

    public function details(Request $request, $id) {
        $transaction = DetailTransaction::with(['transaction.user', 'product.galleries'])
        ->findOrFail($id);

        return view('pages.dashboard-transactions-details', compact('transaction'));
    }

    public function update(Request $request, $id) {
        $data = $request->all();
        $item = DetailTransaction::findOrFail($id);
        $item->update($data);

        return redirect()->route('dashboard-transactions-details', $id);
    }
}
