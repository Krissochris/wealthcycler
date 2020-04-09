<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public $table = 'countries';

    protected $fillable = ['iso_3166_2', 'name', 'default_selection'];



    public $timestamps = false;
}
