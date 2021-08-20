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
        'prod_group',
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
        'prodImgs',
        'variants'
    ];

    public static function genders() {
        return [
            'Man',
            'Woman',
            'Unisex',
            'Boy',
            'Girl',
            'Baby Boy',
            'Baby Girl'
        ];
    }

    public static function fullName(Product $product) {
        return $product->anime->name . ' - ' . $product->name . ' - ' . $product->color;
    }

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

    public function variants() {
        return $this->hasMany('App\Variant');
    }
}
