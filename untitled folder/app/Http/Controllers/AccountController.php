<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\TransferRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Models\Account;
use App\Models\Currency;
use App\Models\Transaction;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = Account::where('user_id', auth()->id())->get();
        $currencies = Currency::get();
        return view('account.index')->with(['accounts' => $accounts, 'currencies' => $currencies]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAccountRequest $request)
    {
        $accountData = $request->validated();
        $accountData['user_id'] = auth()->id();
        $account = Account::create($accountData);
        Transaction::create([
            'account_id' => $account->id,
            'debit' => 0,
            'credit' => $request->credit,
            'note' =>  "Opening Balance",
            'transaction_datetime' => now(),
            'currency' => $request->currency
        ]);
        return redirect()->route('account.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {
        if(auth()->id() == $account->user_id){
            $transactions = Transaction::where('account_id', $account->id)->paginate(8);
            return view('account.detail')->with(['transactions' => $transactions, 'account' => $account]);
        }
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccountRequest $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        //
    }

    public function transfer(TransferRequest $request)
    {
        $fromAccount = Account::find($request->from_account);
        $toAccount = Account::find($request->to_account);

        if ($request->amount > $fromAccount->balance) {
            return redirect()->back()->withInput()->withErrors(['amount' => 'Insufficient Amount.']);
        }
        $debitMsg = "To: $toAccount->name";
        $creditMsg = "From: $fromAccount->name";
        if ($request->rate) {
            $creditAmount = $request->amount * $request->rate;
            $debitMsg .= " (Rate: $request->rate)";
            $creditMsg .= " (Rate: $request->rate)";
        } else {
            $creditAmount = $request->amount;
        }
        $debitAmount = $request->amount;

        //    initiate debit transaction
        Transaction::create([
            'account_id' => $fromAccount->id,
            'debit' => $debitAmount,
            'credit' => 0,
            'note' =>  $debitMsg,
            'transaction_datetime' => now(),
            'currency' => $fromAccount->currency
        ]);
        $fromAccount->debit += $debitAmount;
        $fromAccount->save();

        //    initiate credit transaction
        Transaction::create([
            'account_id' => $toAccount->id,
            'debit' => 0,
            'credit' => $creditAmount,
            'note' => $creditMsg,
            'transaction_datetime' => now(),
            'currency' => $toAccount->currency
        ]);
        $toAccount->credit += $creditAmount;
        $toAccount->save();

        return redirect()->route('account.index'); 
    }
}
