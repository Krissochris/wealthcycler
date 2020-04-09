<?php

namespace App\Http\Controllers;

use App\Currency;
use Illuminate\Http\Request;

class CurrenciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->hasPermission('index_currency');

        $currencies = Currency::all();

        return view('currencies.index', compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->hasPermission('add_currency');

        return view('currencies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->hasPermission('add_currency');

        $request->validate([
            'code' => 'required|max:3',
            'name' => 'required|string'
        ]);
        if ( $newCurrency = Currency::create($request->only(['code', 'name']))) {
            flash()->success('New currency was successfully created.');
            return redirect()->route('currency_exchange_rates:create',['currency_id' => $newCurrency['id']]);
        } else {
            flash()->error('New currency could not be added. Please try again.');
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {
        $this->hasPermission('edit_currency');

        return view('currencies.edit',compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Currency $currency)
    {
        $this->hasPermission('edit_currency');

        $request->validate([
            'code' => 'required|max:3',
            'name' => 'required|string'
        ]);
        if ($currency->update($request->only(['code', 'name']))) {
            flash()->success('Currency was successfully updated!.');
        } else {
            flash()->error('Currency could not be successfully updated.');
        }
        return redirect()->route('currencies:index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        $this->hasPermission('delete_currency');

        try {
            if ($currency->delete()) {
                flash()->success('Currency was successfully deleted.');
            } else {
                flash()->error('Currency could not be deleted.');
            }
        } catch ( \Exception $exception) {
            flash()->error($exception->getMessage());
        }
        return redirect()->route('currencies.index');
    }
}
