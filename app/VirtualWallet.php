<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VirtualWallet extends Model
{

    protected $table = 'virtual_wallets';

    protected $fillable = ['user_id'];

    public function virtual_wallet_transactions()
    {
        return $this->hasMany(VirtualWalletTransaction::class, 'virtual_wallet_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // create a getter and setter functions...

    public function credit($amount)
    {
        if (is_numeric($amount)) {
            $amount = floatval($amount);
            $this->forceFill([
                'amount' => $this->amount + $amount,
                'total_amount' => $this->total_amount + $amount
            ]);
            if ($this->update()){
                $this->createTransactionRecord($amount, 'credit');
                return true;
            }
        }
        return false;
    }

    public function debit($amount)
    {
        if (is_numeric($amount)) {
            $amount = floatval($amount);
            $this->forceFill([
                'amount' => $this->amount - $amount,
            ]);
            if ($this->update()) {
                $this->createTransactionRecord($amount, 'debit');
                return true;
            }
        }
        return false;
    }


    public function createTransactionRecord($amount, $type)
    {
        $record = [
            'amount' => $amount
        ];
        if ('credit' === $type) {
            $record['description'] = sprintf('The sum of %01.2f was credited to your virtual wallet', $amount);
        } elseif ('debit' === $type) {
            $record['description'] = sprintf('The sum of %01.2f was debited from your virtual wallet', $amount);
        }
        $this->virtual_wallet_transactions()
            ->create($record);
    }
}
