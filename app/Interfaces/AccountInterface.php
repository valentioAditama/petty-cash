<?php

namespace App\Interfaces;

use App\Models\Account;
use Illuminate\Database\Eloquent\Collection;

interface AccountInterface
{

    public function getAllAccountsByUserId($userId): Collection;

    public function createAccount(array $accountDetail): Account;

    public function getAccountById($id): ?Account;

    public function increaseCredit(Account $account, $amount): void;

    public function increaseDebit(Account $account, $amount): void;

}
