<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimony extends Model
{
    protected $fillable = ['user_id', 'testimony', 'status'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
