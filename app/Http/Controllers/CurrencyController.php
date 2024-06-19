<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCurrencyRequest;
use App\Repositories\CurrencyRepository;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CurrencyRepository $currencyRepository)
    {
        $currencies = $currencyRepository->getAllCurrency();
        return view('currency.index')->with('currencies',$currencies);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCurrencyRequest $request,CurrencyRepository $currencyRepository)
    {
        $currency = $currencyRepository->createCurrency($request->validated());
        return redirect()->route('currency.index');
    }
}
