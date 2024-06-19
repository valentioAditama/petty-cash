<?php
namespace App\Interfaces;

interface TransactionInterface {
    public function createTransaction(array $detail): void;
}