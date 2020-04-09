<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VirtualMerges extends Model
{
    protected $table = 'virtual_merges';

    CONST ACTIVE = 1;
    CONST COMPLETED = 2;
    CONST CANCELLED = -1;

    protected $fillable = ['provide_donation_id',
        'get_donation_id', 'amount', 'status'];

    public function provide_donation()
    {
        return $this->belongsTo(ProvideDonation::class);
    }

    public function get_donation()
    {
        return $this->belongsTo(GetDonation::class);
    }

    public function updateStatus($status)
    {
        return $this->update([
            'completed_at' => now(),
            'status' => $status
        ]);
    }
}
