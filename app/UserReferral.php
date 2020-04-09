<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserReferral extends Model
{
    protected $table = 'user_referrals';

    protected $fillable = ['referral_user_id', 'referred_user_id'];


    public function referred_user()
    {
        return $this->belongsTo(User::class, 'referred_user_id', 'id');
    }

    public function referral_user()
    {
        return $this->belongsTo(User::class, 'referral_user_id', 'id');
    }

}
