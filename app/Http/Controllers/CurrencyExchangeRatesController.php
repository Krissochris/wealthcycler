<?php

namespace App\Http\Controllers;

use App\CurrencyExchangeRate;
use Illuminate\Http\Request;
use App\Currency;

class CurrencyExchangeRatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->hasPermission('index_currency_exchange_rate');

        $currency_exchange_rates = CurrencyExchangeRate::query()
            ->with(['currency'])
            ->get()->all();
        return view('currency_exchange_rates.index', compact('currency_exchange_rates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->hasPermission('add_currency_exchange_rate');

        $currencies = Currency::pluck('code', 'id');
        return view('currency_exchange_rates.create', compact('currencies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->hasPermission('add_currency_exchange_rate');

        $request->validate([
            'rate' => 'required|numeric',
            'target_currency' => 'required'
        ]);

        if ($newCurrencyExchangeRate = CurrencyExchangeRate::create($request->only(['rate', 'target_currency']))) {
            flash()->success('Currency exchange was successfully added.');
        } else {
            flash()->error('Currency exchange rate could not be added. Please try again later.');
        }
        return redirect()->route('currency_exchange_rates:index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CurrencyExchangeRate  $currencyExchangeRate
     * @return \Illuminate\Http\Response
     */
    public function show(CurrencyExchangeRate $currencyExchangeRate)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CurrencyExchangeRate  $currencyExchangeRate
     * @return \Illuminate\Http\Response
     */
    public function edit(CurrencyExchangeRate $currencyExchangeRate)
    {
        $this->hasPermission('edit_currency_exchange_rate');

        $currencies = Currency::pluck('code', 'id');
        return view('currency_exchange_rates.edit', compact('currencyExchangeRate', 'currencies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CurrencyExchangeRate  $currencyExchangeRate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CurrencyExchangeRate $currencyExchangeRate)
    {
        $this->hasPermission('edit_currency_exchange_rate');

        $request->validate([
            'rate' => 'required|numeric',
            'target_currency' => 'required'
        ]);
        if ($currencyExchangeRate->update($request->only(['rate', 'target_currency']))) {
            flash()->success('Currency exchange rate was successfully updated.');
            return redirect()->route('currency_exchange_rates:index');
        } else {
            flash()->error('Currency exchange rate could not be updated. Please try again.');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CurrencyExchangeRate  $currencyExchangeRate
     * @return \Illuminate\Http\Response
     */
    public function destroy(CurrencyExchangeRate $currencyExchangeRate)
    {
        $this->hasPermission('delete_currency_exchange_rate');
        try {
            if ($currencyExchangeRate->delete()) {
                flash()->success('Currency exchange rate was successfully deleted.');
            } else {
                flash()->error('Currency exchange rate could not be deleted. Please try again.');
            }
        } catch (\Exception $exception) {
            flash()->error($exception->getMessage());
        }
        return back();
    }
}
