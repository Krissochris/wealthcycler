<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class DividendWalletTransaction extends Model
{

    protected $table = 'dividend_wallet_transactions';

    protected $fillable = [
        'dividend_wallet_id',
        'amount',
        'description',
    ];


    public function dividend_wallet()
    {
        return $this->belongsTo(DividendWallet::class, 'dividend_wallet_id', 'id');
    }
}
