<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSavingWallet extends Model
{
    protected $table = 'user_saving_wallets';

    protected $fillable = ['user_id'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function user_saving_wallet_transactions()
    {
        return $this->hasMany(UserSavingWalletTransaction::class);
    }


    public function credit($amount)
    {
        if (is_numeric($amount)){
            $amount = floatval($amount);
            $this->forceFill([
                'amount' => $this->amount + $amount,
                'total_amount' => $this->total_amount + $amount
            ]);
            if ($this->update())
            {
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
                'amount' => $this->amount - $amount
            ]);
            if ($this->update()){
                $this->createTransactionRecord($amount, 'debit');

                // update the debit wallet
                $debitWallet = UserDebitWallet::query()
                    ->where('user_id', $this->user_id)
                    ->first();
                if ($debitWallet) {
                    $debitWallet->credit($amount);
                }
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
        if ('credit' === $type){
            $record['description'] = sprintf('The sum of %01.2f was credited to your saving wallet', number_format($amount, 2) );
        } elseif ('debit' === $type){
            $record['description'] = sprintf('The sum of %01.2f was debited from your saving wallet', number_format($amount, 2) );
        }
        $this->user_saving_wallet_transactions()
            ->create($record);
    }
}
