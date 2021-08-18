<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'season_id',
        'anime_id',
        'thumb',
        'name',
        'slug',
        'desc',
        'color',
        'gender',
        'price'
    ];

    protected $with = [
        'categories',
        'anime',
        'season',
        'prodImgs'
    ];

    public function categories() {
        return $this->belongsToMany('App\Category');
    }

    public function anime() {
        return $this->belongsTo('App\Anime');
    }

    public function season() {
        return $this->belongsTo('App\Season');
    }

    public function prodImgs() {
        return $this->hasMany('App\ProdImg');
    }
}
