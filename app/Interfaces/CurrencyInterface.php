<?php

namespace App\Interfaces;


use App\Models\Currency;
use Illuminate\Database\Eloquent\Collection;

interface CurrencyInterface {
    
    public function createCurrency(array $detail): Currency;

    public function getAllCurrency(): Collection;

}