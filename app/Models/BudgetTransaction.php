<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['budget_id', 'transaction_id', 'amount'];

    public function budget()
    {
        return $this->belongsTo(Budget::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
