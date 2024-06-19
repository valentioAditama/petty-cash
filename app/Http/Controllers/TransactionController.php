<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Repositories\AccountRepository;
use App\Repositories\TransactionRepository;

class TransactionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request, AccountRepository $accountRepository, TransactionRepository $transactionRepository)
    {
        $account = $accountRepository->getAccountById($request->account);
        $amount = $request->amount;

        $message = $request->note;
        if ($request->type == 'D') {
            //    initiate debit transaction
            $transactionRepository->createTransaction([
                'account_id' => $account->id,
                'debit' => $amount,
                'credit' => 0,
                'note' =>  $message,
                'transaction_datetime' => $request->date . ' ' . now()->format('H:i:s'),
                'currency' => $account->currency
            ]);
            $accountRepository->increaseDebit($account, $amount);
        } elseif ($request->type == 'C') {
            //    initiate credit transaction
            $transactionRepository->createTransaction([
                'account_id' => $account->id,
                'debit' => 0,
                'credit' => $amount,
                'note' => $message,
                'transaction_datetime' => $request->date . ' ' . now()->format('H:i:s'),
                'currency' => $account->currency,
            ]);
            $accountRepository->increaseCredit($account, $amount);
        }
        return redirect()->route('account.show', $request->account)->with('status', 'transaction-created');
    }
}
