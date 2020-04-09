<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLeader extends Model
{
    protected $fillable = ['user_id', 'leader_id'];
}
