<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    protected $table = 'anime';
    
    public function products() {
        return $this->hasMany('App\Product');
    }
}
