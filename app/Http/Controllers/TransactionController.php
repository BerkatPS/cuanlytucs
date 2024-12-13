<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Budget;
use App\Models\BudgetTransaction;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::where('user_id', auth()->id())->latest();

        // Filter by category
        if ($request->has('category_id') && $request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by transaction type
        if ($request->has('type') && $request->type !== '') {
            $query->where('type', $request->type);
        }

        // Filter by date range
        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Get transactions
        $transactions = $query->get();
        $categories = Category::all();

        return view('dashboard.transaction', compact('transactions', 'categories'));
    }


    public function transactions()
    {
        $transactions = Transaction::with('account')->latest()->get();
        $accounts = Account::where('user_id', auth()->id())->get();
        $categories = Category::all();
        $budgets = Budget::with('category')
            ->where('user_id', auth()->id())
            ->get();

        return view('dashboard.transactions', compact('transactions', 'accounts', 'categories','budgets'));

    }

    public function storeTransaction(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:1',
            'type' => 'required|in:0,1',  // 0 = Pengeluaran, 1 = Pemasukan
            'account_id' => 'required|exists:accounts,id',
            'category_id' => 'required|exists:categories,id',
            'budget_id' => 'nullable|exists:budgets,id', // ID Budget opsional
        ]);

        // Ambil akun yang terpilih
        $account = Account::find($validated['account_id']);

        // Mengecek tipe transaksi dan memperbarui saldo akun
        if ($validated['type'] == 0) {
            // Pengeluaran, kurangi saldo akun
            if ($account->balance < $validated['amount']) {
                return redirect()->back()->withErrors('Saldo akun tidak cukup untuk transaksi ini.');
            }
            $account->balance -= $validated['amount'];
        } else {
            // Pemasukan, tambah saldo akun
            $account->balance += $validated['amount'];
        }

        // Simpan transaksi
        $transaction = Transaction::create([
            'description' => $validated['description'],
            'amount' => $validated['amount'],
            'type' => $validated['type'],
            'account_id' => $validated['account_id'],
            'category_id' => $validated['category_id'],
            'user_id' => auth()->id(),
        ]);

        // Jika budget_id ada, tambahkan ke tabel budget_transactions
        if (!empty($validated['budget_id'])) {
            $budget = Budget::find($validated['budget_id']);

            // Cek apakah transaksi akan menyebabkan anggaran melebihi batas
            if ($budget->totalSpent() + $validated['amount'] > $budget->limit_amount) {
                return redirect()->back()->withErrors('Transaksi ini akan menyebabkan anggaran melebihi batas!');
            }

            // Simpan ke tabel budget_transactions
            BudgetTransaction::create([
                'budget_id' => $validated['budget_id'],
                'transaction_id' => $transaction->id,
                'amount' => $validated['amount'],
            ]);
        }

        // Update saldo akun
        $account->save();

        // Redirect setelah transaksi berhasil disimpan
        return redirect()->route('transactions')->with('success', 'Transaksi berhasil disimpan!');
    }

}
