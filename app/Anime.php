<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    protected $table = 'anime';

    protected $fillable = ['name'];
    
    public function products() {
        return $this->hasMany('App\Product');
    }
}
