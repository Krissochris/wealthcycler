<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VirtualWalletTransaction extends Model
{
    protected $fillable = ['virtual_wallet_id', 'amount', 'description'];

}
