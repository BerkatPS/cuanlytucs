<?php

// Controller untuk mengelola budget transactions
namespace App\Http\Controllers;

use App\Models\BudgetTransaction;
use App\Models\Budget;
use App\Models\Transaction;
use Illuminate\Http\Request;

class BudgetTransactionController extends Controller
{
    // Menampilkan form untuk menambah transaksi anggaran
    public function create()
    {
        $budgets = Budget::all();  // Mendapatkan semua budget
        $transactions = Transaction::all();  // Mendapatkan semua transaksi
        return view('dashboard.add_budget_transaction', compact('budgets', 'transactions'));
    }

    // Menyimpan transaksi anggaran
    public function store(Request $request)
    {
        $request->validate([
            'budget_id' => 'required|exists:budgets,id',
            'transaction_id' => 'required|exists:transactions,id',
            'amount' => 'required|numeric|min:0',
        ]);

        BudgetTransaction::create([
            'budget_id' => $request->budget_id,
            'transaction_id' => $request->transaction_id,
            'amount' => $request->amount,
        ]);

        return redirect()->route('dashboard.budget_transactions')->with('success', 'Transaksi anggaran berhasil ditambahkan');
    }

    // Menampilkan daftar transaksi anggaran
    public function index()
    {
        $budgetTransactions = BudgetTransaction::with(['budget', 'transaction'])->get();  // Eager load budget dan transaction
        return view('dashboard.budget_transactions', compact('budgetTransactions'));
    }
}
