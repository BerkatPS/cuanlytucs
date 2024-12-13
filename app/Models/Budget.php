<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'category_id', 'limit_amount', 'start_date', 'end_date'
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi dengan budget_transactions
    public function budgetTransactions()
    {
        return $this->hasMany(BudgetTransaction::class);
    }

    // Menghitung total transaksi untuk anggaran ini
    public function totalSpent()
    {
        return $this->budgetTransactions()->sum('amount');
    }

    // Mengecek apakah anggaran terlampaui
    public function isOverBudget()
    {
        return $this->totalSpent() > $this->limit_amount;
    }

    // Menghitung jumlah anggaran yang tersisa
    public function remainingAmount()
    {
        return max(0, $this->limit_amount - $this->totalSpent());
    }
}
