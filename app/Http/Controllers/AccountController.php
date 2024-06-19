<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\TransferRequest;
use App\Models\Account;
use App\Models\Currency;
use App\Models\Transaction;
use App\Repositories\AccountRepository;

class AccountController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(AccountRepository $accountRepository)
    {
        $accounts = $accountRepository->getAllAccountsByUserId(auth()->user()->id);
        $currencies = Currency::get();
        return view('account.index')->with(['accounts' => $accounts, 'currencies' => $currencies]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAccountRequest $request, AccountRepository $accountRepository)
    {
        $accountData = $request->validated();
        $accountData['user_id'] = auth()->id();
        $account = $accountRepository->createAccount($accountData) ;
        Transaction::create([
            'account_id' => $account->id,
            'credit' => 0,
            'debit' => $request->credit,
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

    public function transfer(TransferRequest $request, AccountRepository $accountRepository)
    {
        $fromAccount = $accountRepository->getAccountById($request->from_account);
        $toAccount = $accountRepository->getAccountById($request->to_account);

        $fromAccount->balance;

        // Check for sufficient balance in the fromAccount
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

        // Initiate debit transaction
        Transaction::create([
            'account_id' => $fromAccount->id,
            'debit' => $debitAmount,
            'credit' => 0,
            'note' =>  $debitMsg,
            'transaction_datetime' => now(),
            'currency' => $fromAccount->currency
        ]);
        $accountRepository->increaseDebit($fromAccount, $debitAmount); // Decrease balance of fromAccount

        // Initiate credit transaction
        Transaction::create([
            'account_id' => $toAccount->id,
            'debit' => 0,
            'credit' => $creditAmount,
            'note' => $creditMsg,
            'transaction_datetime' => now(),
            'currency' => $toAccount->currency
        ]);
        $accountRepository->increaseCredit($toAccount, $creditAmount); // Increase balance of toAccount

        return redirect()->route('account.index');
    }
}
