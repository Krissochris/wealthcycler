<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProvideDonation extends Model
{
    CONST ACTIVE = 1;
    CONST CANCELLED = -1;
    CONST IN_PROGRESS = 2;
    CONST COMPLETED = 3;

    protected $table = 'virtual_provide_donations';

    protected $fillable = ['user_id', 'package_id', 'amount', 'status'];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function get_donation()
    {
        return $this->hasOne(GetDonation::class);
    }

    public function virtual_merges()
    {
        return $this->hasMany(VirtualMerges::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function updateStatus($status)
    {
        return $this->update([
            'status' => $status
        ]);
    }
}
