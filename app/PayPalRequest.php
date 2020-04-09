<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayPalRequest extends Model
{
    protected $table = 'pay_pal_requests';

    protected $fillable = ['id', 'intent', 'item_no', 'payment_method', 'transaction_amount',
    'transaction_currency', 'transaction_description', 'transaction_invoice_number', 'state',
        'value_given', 'create_time'
    ];

    public $timestamps = false;
}
