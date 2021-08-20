<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Variant extends Model
{
    
    protected $fillable = [
        'product_id',
        'size',
        'sku',
        'discount',
        'availability',
        'stock'
    ];
    
    public function product() {
        return $this->belongsTo('App\Product');
    }

    public static function sku($product, $size, $oldSku = '') {
        
        function mySplit($string) {
            $chunks = preg_split('/(\s+|\-|\/|\\\\)/', $string, -1, PREG_SPLIT_NO_EMPTY);
            return $chunks;
        }

        function threeChunks($string) {
            $chunks = mySplit($string);
            if (count($chunks) > 3) {
                $chunks = array_slice($chunks, 0, 3);
            }
            return $chunks;
        }

        function acronym($array) {            
            $acronym = '';
            foreach ($array as $word) {
                $acronym .= $word[0];
            }
            return $acronym;
        }

        function colorCode($color) {
            if (count(mySplit($color)) > 1) {
                $chunks = threeChunks($color);
                $colorCode = acronym($chunks);
            } else {
                $colorCode = substr($color, 0, 3);
            }
            return $colorCode;
        }

        $anime = $product->anime->name;
        $productName = $product->name;
        $size = preg_replace('/[^a-z0-9]/i', '', $size) . '-';
        $color = colorCode($product->color);
        $animeCode = acronym(threeChunks($anime)) . '-';
        $productCode = acronym(threeChunks($productName)) .'-';        
        $sku = strtoupper($animeCode . $productCode . $size . $color);

        if (strlen($sku) >16) {
            $sku = substr($sku, 0, 16);
        }

        //unique
        $newSku = $sku;
        $counter = 1;
        $variantCount = Variant::where('sku', $sku)->count();

        while($variantCount == 1) {
            
            if ($sku == $oldSku) {
                return $sku;
            }

            if ($counter == 100){
               $skuLength = strlen($newSku);  
               $newSku = substr($newSku, 0, ($skuLength - 1));
               $counter = 1;
            }

            $sku = $newSku . "-" . $counter;            
            $variantCount = Variant::where('sku', $sku)->count();
            $counter++;
        }

        return $sku;
    }
}
