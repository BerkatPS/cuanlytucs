<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'limit_amount',
        'start_date',
        'end_date',
        'is_over_budget',
    ];

    // Relasi ke kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke transaksi anggaran
    public function budgetTransactions()
    {
        return $this->hasMany(BudgetTransaction::class);
    }

    // Menghitung total pengeluaran dari transaksi terkait anggaran ini
    public function totalSpent()
    {
        return $this->budgetTransactions->sum('amount');
    }

    // Mengecek apakah anggaran sudah melebihi batas
    public function getIsOverBudgetAttribute()
    {
        return $this->totalSpent() > $this->limit_amount;
    }

    // Menghitung jumlah sisa anggaran
    public function remainingAmount()
    {
        return max(0, $this->limit_amount - $this->totalSpent());
    }
}
