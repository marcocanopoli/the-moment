<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Product;
use App\Category;
use Illuminate\Database\Eloquent\Collection;

class ProductController extends Controller
{
   
    public function index(Request $request) {

        // $products = Product::all();
        $queryArray = $request->input();

        //second-level filters
        $currentFilters = [];
        $allFilters = [
            'categories',
            'anime',
            'season',
            'size'
        ];
        
        //remove non-present filters from query and push present filters in new array
        foreach ($allFilters as $filter) {
            if ($request->has($filter)) {
                $currentFilters[$filter] = $request[$filter];
                unset($queryArray[$filter]);
            }
        }
        
        //gets filtered products (first-level filters)
        foreach ($queryArray as $key => $value) {
            $queryArray[$key] = str_replace(';', '', $value);
        }
        $products = Product::where($queryArray)->get();
        
        //gets filtered products (first-level filters)
        foreach ($currentFilters as $key => $filter) {

            $filtered = new Collection();
            $filterValues = explode(";", $filter);

            if ($key === 'size') {                
                foreach ($filterValues as $singleFilter) {
                    $currentFiltered = Product::whereHas('variants', function (Builder $query) use ($singleFilter) {
                        $query->where('size', $singleFilter);
                        })->get();
                    
                    $filtered = $filtered->merge($currentFiltered);
                }                 
            } 
            else {
                foreach ($filterValues as $singleFilter) {
                    $currentFiltered = Product::whereHas($key, function (Builder $query) use ($singleFilter) {
                        $query->where('name', $singleFilter);
                        })->get();

                    $filtered = $filtered->merge($currentFiltered);
                }                    
            }

            //intersection with first-level filtered products
            $products = $products->intersect($filtered);
        }

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
