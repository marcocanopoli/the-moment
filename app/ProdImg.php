<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdImg extends Model
{
    protected $table = 'prod_imgs';
    
    protected $fillable = ['product_id', 'path'];

    public function product() {
        return $this->belongsTo('App\Product');
    }
}
