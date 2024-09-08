<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;

class AdminDashboardController extends Controller
{
    public function index() {
        $customer = User::count();
        $revenue = Transaction::where('transaction_status', 'SUCCESS')->sum('total');
        $transactions = Transaction::count();

        return view('pages.admin.dashboard', [
            'customer' => $customer,
            'revenue' => $revenue,
            'transactions' => $transactions,
        ]);
    }
}
