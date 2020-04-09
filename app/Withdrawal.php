<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $table = 'user_withdrawals';

    protected $fillable = ['user_id', 'amount', 'status', 'comment'];
}
