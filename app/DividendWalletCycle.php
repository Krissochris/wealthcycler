<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class DividendWalletCycle extends Model
{
    protected $table = 'dividend_wallet_cycles';

    protected $fillable = [
        'dividend_wallet_id',
        'cycle_balance_received',
        'status'
    ];

    public function dividend_wallet()
    {
        return $this->belongsTo(DividendWallet::class);
    }
}
