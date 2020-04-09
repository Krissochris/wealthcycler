<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserDebitWallet
 * @package App
 * @property float $amount
 */
class UserDebitWallet extends Model
{
    protected $table = 'user_debit_wallets';

    protected $fillable = ['user_id'];

    public function credit($amount)
    {
        if (is_numeric($amount)) {
            $amount = floatval($amount);
            $this->forceFill([
                'amount' => $amount + $this->amount
            ]);
            return $this->update();
        }
        return false;
    }
}
