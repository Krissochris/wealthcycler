<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VirtualCycle extends Model
{
    protected $fillable = ['user_id', 'package_id',
        'taxed', 'created_get_donation_id', 'completed_get_donation_id'];

    public function taxed()
    {
        return $this->update(['taxed' => 1]);
    }
}
