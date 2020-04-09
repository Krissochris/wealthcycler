<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{

    protected $fillable = ['name', 'description', 'auto_upgrade',
    'next_package_id', 'amount', 'entry_package'];

    protected static function boot() {
        parent::boot();

        static::deleting(function($package) {
            $associatedPackages = Package::query()
                ->where('next_package_id', $package->id)
                ->get()
                ->all();
            foreach($associatedPackages as $associatedPackage) {
                $associatedPackage->update(['next_package_id' => null]);
            }
        });
    }

    public function next_package()
    {
        return $this->belongsTo(Package::class, 'next_package_id', 'id');
    }

}
