<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Account;
use App\Models\Currency;
use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {
        $account = Account::find($request->account);
        $amount = $request->amount;

        $message = $request->note;
        if ($request->type == 'D') {
            //    initiate debit transaction
            Transaction::create([
                'account_id' => $account->id,
                'debit' => $amount,
                'credit' => 0,
                'note' =>  $message,
                'transaction_datetime' => $request->date. ' '. now()->format('H:i:s'),
                'currency' => $account->currency
            ]);
            $account->debit += $amount;
            $account->save();
        } elseif ($request->type == 'C') {
            //    initiate credit transaction
            Transaction::create([
                'account_id' => $account->id,
                'debit' => 0,
                'credit' => $amount,
                'note' => $message,
                'transaction_datetime' => $request->date. ' '. now()->format('H:i:s'),
                'currency' => $account->currency
            ]);
            $account->credit += $amount;
            $account->save();
        }
        return redirect()->route('account.show', $request->account)->with('status', 'transaction-created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
