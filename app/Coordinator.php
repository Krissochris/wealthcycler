<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coordinator extends Model
{
    protected $table = 'state_cordinators';

    protected $fillable = ['user_id', 'state_id', 'director_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function director()
    {
        return $this->belongsTo(Director::class);
    }
}
