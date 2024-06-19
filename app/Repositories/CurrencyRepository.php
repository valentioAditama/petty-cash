<?php

namespace App\Repositories;

use App\Interfaces\CurrencyInterface;
use App\Models\Currency;
use Illuminate\Database\Eloquent\Collection;

class CurrencyRepository implements CurrencyInterface{

    public function createCurrency(array $detail): Currency{
        return Currency::create($detail);
    }

    public function getAllCurrency(): Collection{
        return Currency::get();
    }
}