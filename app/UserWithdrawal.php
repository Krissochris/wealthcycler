<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserWithdrawal extends Model
{
    protected $table = 'user_withdrawals';

    protected $fillable = ['user_id', 'amount', 'status', 'comment', 'type'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
