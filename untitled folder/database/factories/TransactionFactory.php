<?php

namespace Database\Factories;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /** \App\Models\Transaction::factory(1000)->create();
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $debit = fake()->randomElement([true, false]);
        if ($debit) {
            $debitAmt = fake()->randomNumber(5);
            $creditAmt = 0;
        } else {
            $creditAmt = fake()->randomNumber(5);
            $debitAmt = 0;
        }
        $account = fake()->randomElement([1, 2]);
        if ($account == 1) {
            $currency = "THB";
        } else {
            $currency = "MMK";
        }

        $accountObj = Account::find($account);
        $accountObj->credit += $creditAmt;
        $accountObj->debit += $debitAmt;
        $accountObj->save();

        return [
            'account_id' => $account,
            'debit' => $debitAmt,
            'credit' => $creditAmt,
            'note' => 'Dummy Note',
            'transaction_datetime' => now(),
            'currency' => $currency
        ];
    }
}
