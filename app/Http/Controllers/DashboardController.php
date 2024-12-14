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
    public function index(Request $request)
    {
        // Mengambil data pengguna yang sedang login
        $accounts = Account::with('user')->where('user_id', auth()->id())
            ->latest()
            ->take(5)
            ->get();

        // Mengambil kategori dengan relasi 'budgets' menggunakan eager loading
        $categories = Category::with('budgets')->where('user_id', auth()->id())
            ->when($request->has('search_name'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search_name . '%');
            })
            ->latest()
            ->take(5)
            ->get();

        // Mengambil transaksi
        $transactions = Transaction::with('category', 'account')->where('user_id', auth()->id())
            ->latest()
            ->take(5)
            ->get();

        // Mengambil anggaran
        $budgets = Budget::with('category')->where('user_id', auth()->id())->get();

        // Memperbaiki penghitungan anggaran per kategori
        $categoryNames = $categories->pluck('name');
        $categoryExpenses = $categories->map(function ($category) {
            return $category->transactions->where('type', 0)->sum('amount');
        });


        \Log::info('Category Names: ', $categoryNames->toArray());
        \Log::info('Category Budgets: ', $categoryExpenses->toArray());

        return view('dashboard.index', compact('accounts', 'categories', 'transactions', 'budgets', 'categoryNames', 'categoryExpenses'));
    }


}
