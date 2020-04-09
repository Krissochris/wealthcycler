<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserVirtualWithdrawal extends Model
{
    protected $fillable = ['user_id', 'amount', 'status'];

}
