<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'thumb',
        'name',
        'slug',
        'desc',
    ];

    public function products() {
        return $this->belongsToMany('App\Product');
    }
}
