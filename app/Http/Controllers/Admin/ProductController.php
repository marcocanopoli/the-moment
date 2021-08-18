<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Product;
use App\Category;
use App\Season;
use App\Anime;
use App\ProdImg;

class ProductController extends Controller
{   
    private $genders = [
        'Man',
        'Woman',
        'Unisex',
        'Boy',
        'Girl',
        'Baby Boy',
        'Baby Girl'
    ];

    private $validation = [
        'thumb' => 'nullable|mimes:jpeg,jpg,png,bmp,gif,svg,webp|max:5120',
        'prod_imgs.*' => 'mimes:jpeg,jpg,png,bmp,gif,svg,webp|max:5120',
        'name' => 'required|max:100',
        'anime' => 'exists:anime,id',
        'desc' => 'nullable',
        'color' => 'required|max:50',
        'season' => 'exists:seasons,id',
        'price' => 'required|numeric',
        'categories' => 'exists:categories,id',
        'gender' => 'required'
    ];

    private function createSlug($data) {
        $anime = Anime::find($data['anime_id']);
        $string = $anime->name . ' ' . $data['name'] . ' ' . $data['color'];
        $slug = Str::slug($string, '-');

        $existingProduct = Product::where('slug', $slug)->count();

        $slugString = $slug;
        $counter = 1;

        while($existingProduct >= 1) {
            $slug = $slugString . "-" . $counter;
            $existingProduct = Product::where('slug', $slug)->count();
            $counter++;
        }

        return $slug;
    }

    private function fullName(Product $product) {
        return $product->anime->name . ' - ' . $product->name . ' - ' . $product->color;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(10);
        // $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $anime = Anime::all();
        $categories = Category::all();
        $genders = $this->genders;
        $seasons = Season::all();        

        return view('admin.products.create', compact('anime', 'categories', 'genders', 'seasons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $request->validate($this->validation);
        
        $newProduct = new Product();
        $slug = $this->createSlug($data);
        $data['slug'] = $slug;
        
        if (array_key_exists('thumb', $data)) {
            $data['thumb'] = Storage::disk('public')->put('thumbnails', $data['thumb']);
        }        
        
        // dd($data);
        $newProduct->fill($data);
        $newProduct->save();
        
        if (array_key_exists('prod_imgs', $data)) {
            foreach ($data['prod_imgs'] as $prodImg) {
                $path = Storage::disk('public')->put('product_imgs/' . $newProduct->id, $prodImg);                
                ProdImg::create(['product_id' => $newProduct->id, 'path' => $path]);
            }
        }

        if (array_key_exists('categories', $data)) {
            $newProduct->categories()->attach($data['categories']);
        }

        return redirect()
            ->route('admin.products.show', $newProduct->id)
            ->with('created', $this->fullName($newProduct));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        // $product = Product::findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $anime = Anime::all();
        $categories = Category::all();
        $genders = $this->genders;
        $seasons = Season::all();
        $fullName = $this->fullName($product);

        return view('admin.products.edit', compact('product','anime', 'categories', 'genders', 'seasons', 'fullName'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->all();
        $request->validate($this->validation);
        $slug = $this->createSlug($data);
        $data['slug'] = $slug;

        //replace & delete thumbnail
        if (array_key_exists('thumb', $data)) {            
            if ($product->thumb){
                Storage::delete($product->thumb);
            }
            $data['thumb'] = Storage::disk('public')->put ('thumbnails', $data['thumb']);
        }

        $product->update($data);

        //replace categories
        if (array_key_exists('categories', $data)) {
            $product->categories()->sync($data['categories']);
        } else {
            $product->categories()->detach();
        } 

        return redirect()
            ->route('admin.products.show', $product->id)
            ->with('updated', $this->fullName($product));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->thumb) {
            Storage::delete($product->thumb);
        }

        $fullName = $this->fullName($product);
        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('deleted', $fullName);
    }
}
