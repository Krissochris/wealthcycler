<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = ['country_code', 'code', 'name', 'country_id', 'default_selection'];

    public $timestamps = false;

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
