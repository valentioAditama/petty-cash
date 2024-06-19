<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'debit',
        'credit',
        'currency',
        'user_id'
    ];


    public function getBalanceAttribute()
    {
        return $this->credit - $this->debit;    
    }
}
