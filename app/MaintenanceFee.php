<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaintenanceFee extends Model
{
    protected $table = 'maintenance_fees';

    protected $fillable = ['user_id', 'get_donation_id', 'package_id', 'amount'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function get_donation()
    {
        return $this->belongsTo(GetDonation::class, 'get_donation_id', 'id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id', 'id');
    }
}
