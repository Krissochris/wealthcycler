<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPaymentDetail extends Model
{
    protected $fillable = ['user_id', 'account_name', 'account_number', 'bank_id', 'btc_address'];

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id', 'id');
    }

}
