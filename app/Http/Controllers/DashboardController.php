<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Account;
use App\Models\Category;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data pengguna yang sedang login
        $accounts = Account::with('user')->where('user_id', auth()->id())->get();
        $categories = Category::all();
        $transactions = Transaction::with('category', 'account')->where('user_id', auth()->id())->latest()->take(5)->get();

        // Mengambil data untuk statistik anggaran
        $budgets = Budget::with('category')->where('user_id', auth()->id())->get();

        return view('dashboard.index', compact('accounts', 'categories', 'transactions', 'budgets'));
    }
}

