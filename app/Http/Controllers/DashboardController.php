<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\DetailTransaction;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $transactions = DetailTransaction::with('transaction.user', 'product.galleries')
            ->whereHas('product', function ($product) {
                $product->where('users_id', Auth::user()->id);
            });

        $revenue = $transactions->get()->reduce(function ($carry, $item) {
                return $carry + $item->price;
            });

        $customer = User::count();

        return view('pages.dashboard', [
            'transaction_count' => $transactions->count(),
            'transaction_data' => $transactions->get(),
            'customer' => $customer,
            'revenue' => $revenue,
        ]);
    }
}
