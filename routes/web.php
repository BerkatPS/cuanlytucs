<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\BudgetTransactionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// routes/web.php

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);

// Route untuk register
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);



// Route untuk logout
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Route untuk dashboard yang dilindungi middleware 'auth'
// Middleware auth untuk halaman yang perlu login
// Route untuk dashboard (Overview)
Route::middleware(['auth'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route untuk akun
Route::middleware(['auth'])->get('/account', [AccountController::class, 'index'])->name('account');

// Route untuk membuat akun baru
Route::middleware(['auth'])->get('/new-account', [AccountController::class, 'new_account'])->name('account.new');

// Route untuk menyimpan akun baru
Route::middleware(['auth'])->post('/account', [AccountController::class, 'create'])->name('account.store');

// Route untuk mengedit akun
Route::middleware(['auth'])->get('/account/{id}/edit', [AccountController::class, 'update'])->name('account.update');

// Route untuk halaman transaksi
Route::middleware(['auth'])->get('/transactions', [TransactionController::class, 'index'])->name('transaction');

// Route untuk logout
Route::middleware(['auth'])->post('/logout', [AuthController::class, 'logout'])->name('logout');

// menampilkan transaksi form
Route::middleware(['auth'])->get('/transactionForm', [TransactionController::class, 'transactions'])->name('transactions');

// menyimpan transaksi
Route::middleware(['auth'])->post('/transactions', [TransactionController::class, 'storeTransaction'])->name('transactions.store');

// Route untuk kategori
Route::middleware(['auth'])->get('/categories', [CategoryController::class, 'index'])->name('categories');

// Route untuk membuat kategori baru
Route::middleware(['auth'])->get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');

// Menyimpan kategori baru
Route::middleware(['auth'])->post('/categories', [CategoryController::class, 'store'])->name('categories.store');

// Menampilkan form untuk mengedit kategori
Route::middleware(['auth'])->get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');

// Mengupdate kategori
Route::middleware(['auth'])->put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');

// Menghapus kategori
Route::middleware(['auth'])->delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');


Route::middleware('auth')->group(function () {
    // Menampilkan daftar anggaran
    Route::get('/budgets', [BudgetController::class, 'index'])->name('budgets.index');

    // Menampilkan form untuk membuat anggaran
    Route::get('/budgets/create', [BudgetController::class, 'create'])->name('budgets.create');
    Route::post('/budgets', [BudgetController::class, 'store'])->name('budgets.store');

    // Mengedit anggaran
    Route::get('/budgets/{id}/edit', [BudgetController::class, 'edit'])->name('budgets.edit');
    Route::put('/budgets/{id}', [BudgetController::class, 'update'])->name('budgets.update');

    // Menghapus anggaran
    Route::delete('/budgets/{id}', [BudgetController::class, 'destroy'])->name('budgets.destroy');

    // Menambahkan transaksi ke anggaran
    Route::post('/budgets/{budgetId}/transactions', [BudgetController::class, 'addTransaction'])->name('budgets.addTransaction');
});



Route::middleware(['auth'])->group(function () {
    // Menampilkan daftar transaksi anggaran
    Route::get('/budget_transactions', [BudgetTransactionController::class, 'index'])->name('budget_transactions');

    // Menampilkan form untuk menambah transaksi anggaran
    Route::get('/budget_transactions/create', [BudgetTransactionController::class, 'create'])->name('budget_transactions.create');
    Route::post('/budget_transactions', [BudgetTransactionController::class, 'store'])->name('budget_transactions.store');
});
