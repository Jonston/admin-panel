<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Company extends Model
{
    protected $fillable = [
        'name',
        'email',
        'logo',
        'website'
    ];

    public static function boot() {
        parent::boot();

        static::deleting(function($company) {
            Storage::delete($company->logo);
        });
    }
}
