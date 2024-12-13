<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Category;
use App\Models\BudgetTransaction;
use App\Models\Transaction;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    // Menampilkan daftar anggaran untuk pengguna
    public function index()
    {
        // Mengambil data anggaran dengan relasi kategori yang terkait, serta user yang memiliki anggaran
        // Tidak perlu mengambil 'user.account' jika informasi akun tidak digunakan di halaman ini.
        $budgets = Budget::with(['category', 'budgetTransactions'])
            ->where('user_id', auth()->id())  // Pastikan hanya menampilkan anggaran untuk user yang sedang login
            ->paginate(10);

        foreach ($budgets as $budget) {
            $budget->is_over_budget = $budget->isOverBudget();
            $budget->remaining_amount = $budget->remainingAmount();
        }

        return view('dashboard.budgets', compact('budgets'));
    }



    // Menampilkan form untuk menambahkan anggaran
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.budget_create', compact('categories'));
    }

    // Menyimpan anggaran baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id', // Validasi kategori
            'limit_amount' => 'required|numeric|min:1', // Validasi jumlah anggaran
            'start_date' => 'required|date|before:end_date', // Validasi tanggal mulai
            'end_date' => 'required|date|after:start_date', // Validasi tanggal berakhir
        ]);

        Budget::create([
            'user_id' => auth()->id(), // Menyimpan id user yang sedang login
            'category_id' => $validatedData['category_id'],
            'limit_amount' => $validatedData['limit_amount'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
        ]);

        return redirect()->route('budgets.index')->with('success', 'Anggaran berhasil ditambahkan!');

    }


    // Menampilkan form untuk mengedit anggaran
    public function edit($id)
    {
        $budget = Budget::findOrFail($id);
        $categories = Category::all();
        return view('dashboard.budgets.edit', compact('budget', 'categories'));
    }

    // Mengupdate anggaran
    public function update(Request $request, $id)
    {
        $request->validate([
            'limit_amount' => 'required|numeric|min:1',
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date|after:start_date',
            'category_id' => 'required|exists:categories,id'
        ]);

        $budget = Budget::findOrFail($id);
        $budget->update([
            'limit_amount' => $request->limit_amount,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('budgets.index')->with('success', 'Anggaran berhasil diperbarui!');
    }

    // Menghapus anggaran
    public function destroy($id)
    {
        $budget = Budget::findOrFail($id);
        $budget->delete();

        return redirect()->route('budgets.index')->with('success', 'Anggaran berhasil dihapus!');
    }

    // Menambahkan transaksi ke anggaran
    public function addTransaction(Request $request, $budgetId)
    {
        $budget = Budget::findOrFail($budgetId);

        $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
            'amount' => 'required|numeric|min:0'
        ]);

        // Cek apakah transaksi akan melebihi batas anggaran
        if ($budget->totalSpent() + $request->amount > $budget->limit_amount) {
            return redirect()->back()->with('error', 'Transaksi ini akan menyebabkan anggaran melebihi batas!');
        }

        BudgetTransaction::create([
            'budget_id' => $budget->id,
            'transaction_id' => $request->transaction_id,
            'amount' => $request->amount,
        ]);

        return redirect()->route('budgets.index')->with('success', 'Transaksi berhasil ditambahkan!');
    }


}
