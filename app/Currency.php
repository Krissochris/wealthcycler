<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = ['code', 'name'];

    public function currency_exchange_rate()
    {
        return $this->hasOne(CurrencyExchangeRate::class);
    }
}
