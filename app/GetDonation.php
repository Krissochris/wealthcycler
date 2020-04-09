<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GetDonation extends Model
{
    CONST ACTIVE = 1;
    CONST CANCELLED = -1;
    CONST IN_PROGRESS = 2;
    CONST COMPLETED = 3;


    protected $fillable = ['user_id', 'package_id', 'provide_donation_id',
    'amount', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function updateStatus($status)
    {
        return $this->update([
            'status' => $status
        ]);
    }
}
