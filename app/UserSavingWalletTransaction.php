<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSavingWalletTransaction extends Model
{
    protected $table = 'user_saving_wallet_transactions';

    protected $fillable = ['user_saving_wallet_id', 'amount', 'description'];


    protected function savings_wallet()
    {
        return $this->belongsTo(UserSavingWallet::class, 'user_saving_wallet_id', 'id');
    }
}
