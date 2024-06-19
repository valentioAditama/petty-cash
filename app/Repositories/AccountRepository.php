<?php
namespace App\Repositories;

use App\Interfaces\AccountInterface;
use App\Models\Account;
use Illuminate\Database\Eloquent\Collection;

class AccountRepository implements AccountInterface{

    public function getAllAccountsByUserId($userId): Collection{
        return Account::where('user_id', $userId)->get();
    }

    public function createAccount(array $accountDetail): Account{
        return Account::create($accountDetail);
    }

    public function getAccountById($id): ?Account{
        return Account::findOrFail($id);
    }

    public function increaseCredit(Account $account, $amount): void{
        $account->credit += $amount;
        $account->save();
    }

    public function increaseDebit(Account $account, $amount): void{
        $account->debit += $amount;
        $account->save();
    }
}