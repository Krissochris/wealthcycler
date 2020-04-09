<?php

namespace App;

use Kevupton\LaravelCoinpayments\Models\Transaction;

class CoinPaymentTransaction extends Transaction
{
    protected $table = 'coin_payment_transactions';

    public function getTable()
    {
        return $this->table;
    }
}
