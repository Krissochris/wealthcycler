<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPackage extends Model
{
    protected $fillable = ['user_id', 'package_id', 'status'];


    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id', 'id');
    }
}
