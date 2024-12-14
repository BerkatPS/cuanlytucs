<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Account;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $accounts = auth()->user()->accounts; // Mengambil akun yang dimiliki oleh pengguna
        $categories = Category::where('user_id', auth()->id())
            ->when($request->has('search_name'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search_name . '%');
            })
            ->get();
        return view('dashboard.account', compact('accounts', 'categories'));
    }
    public function new_account()
    {

        return view('dashboard.account_new');

    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Update akun pengguna
        $account = Account::where('user_id', auth()->id())->first();
        $account->name = $request->name;
        $account->save();

        return redirect()->route('account')->with('success', 'Akun berhasil diperbarui.');
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'balance' => 'required|numeric|min:1',
            'currency' => 'required|string|in:IDR,USD,EUR',
        ]);

        // Menghapus simbol Rp jika ada dan mengambil angka saja
        $balance = preg_replace('/[^0-9]/', '', $validated['balance']);

        // Menyimpan akun baru
        Account::create([
            'name' => $validated['name'],
            'balance' => $balance,
            'currency' => $validated['currency'],
            'user_id' => auth()->id(),
        ]);

        // Redirect atau memberikan respon sukses
        return redirect()->route('dashboard')->with('success', 'Akun berhasil dibuat!');


    }
}
