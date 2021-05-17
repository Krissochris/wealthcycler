<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DividendWallet extends Model
{

    protected $table = 'dividend_wallets';

    CONST STATUS_ACTIVE = 1;
    CONST STATUS_SUSPENDED = -1;

    protected $fillable = [
        'user_id',
        'balance',
        'total_balance',
        'is_active',
        'last_withdrawal_time',
        'status'
    ];

    protected static function boot() {
        parent::boot();

        static::created(function ($wallet) {
            $wallet->dividend_wallet_cycles()->create();
        });

        static::deleting(function($wallet) {
            // before delete() method call this
            //$wallet->dividend_wallet_cycles()->delete();
        });
    }


    // dividend wallet user relationship
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // dividend wallet cycle relationship
    public function dividend_wallet_cycles()
    {
        return $this->hasMany(DividendWalletCycle::class);
    }


    //dividend wallet transactions relationship.
    public function transactions()
    {
        return $this->hasMany(DividendWalletTransaction::class, 'dividend_wallet_id', 'id');
    }


    public function credit($amount)
    {
        if (!is_numeric($amount)) {
            return false;
        }

        if ($this->notActivated() || $this->isSuspended()) {
            return false;
        }
        $dividend_cycle = $this->dividend_wallet_cycles()
            ->where('status', 1)
            ->first();

        if ($dividend_cycle->cycle_balance_received >= 500) {
            return false;
        }

        $this->balance += (float)$amount;
        $this->total_balance += (float)$amount;

        try {
            DB::beginTransaction();
            $this->update();
            $dividend_cycle->update([
                'cycle_balance_received' => $dividend_cycle->cycle_balance_received + $amount
            ]);

            $this->transactions()->create([
                'amount' => $amount,
                'description' => 'Wallet was credited with '. number_format($amount)
            ]);
            DB::commit();
            return true;

        } catch (\Exception $exception) {
            DB::rollBack();
            return false;
        }
    }


    public function canDebit($amount)
    {
        return false;
    }


    public function debit($amount)
    {
        if (!is_numeric($amount)) {
            return false;
        }
        if ($this->notActivated() || $this->isSuspended()) {
            return false;
        }

        $this->balance -= (float)$amount;
        try {
            DB::beginTransaction();

            $this->update();
            $this->transactions()->create([
                'amount' => $amount,
                'description' => 'Wallet was debited with '. number_format($amount)
            ]);
            DB::commit();
            return true;

        } catch (\Exception $exception) {
            DB::rollBack();
            return false;
        }
    }


    protected function isSuspended()
    {
        return (int)$this->status === -1;
    }

    protected function notActivated()
    {
        return (int)$this->is_active !== 1;
    }

}
