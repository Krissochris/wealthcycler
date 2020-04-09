<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrencyExchangeRate extends Model
{
    protected $fillable = ['rate', 'target_currency'];

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'target_currency', 'id');
    }
}
