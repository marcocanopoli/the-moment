<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        return response()->json($products);
    }

    public function get($slug) {
        $product = Product::where('slug', $slug)
            // ->with(['variants', 'categories']) //eager loading
            ->first();
        return response()->json($product);
    }

    public function getGroup($prod_group) {
        $products = Product::where('prod_group', $prod_group)->get();
        return response()->json($products);
    }
}
