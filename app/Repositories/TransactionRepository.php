<?php

namespace App\Repositories;

use App\Interfaces\TransactionInterface;
use App\Models\Transaction;

class TransactionRepository implements TransactionInterface{

    public function createTransaction(array $detail): void{
        Transaction::create($detail);
        
    }

}