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

    private $rules = [
        'thumb' => 'nullable|mimes:jpeg,jpg,png,bmp,gif,svg,webp|max:5120',
        'prodImgs.*' => 'mimes:jpeg,jpg,png,bmp,gif,svg,webp|max:5120',
        'name' => 'required|max:100',
        'anime_id' => 'required|exists:anime,id',
        'desc' => 'nullable',
        'color' => 'required|max:50',
        'season_id' => 'exists:seasons,id',
        'price' => 'required|numeric|min:0.5',
        'categories' => 'exists:categories,id',
        'gender' => 'required'
    ];

    private function createSlug($data, $oldSlug = '') {
        $anime = Anime::find($data['anime_id']);
        $string = $anime->name . ' ' . $data['name'] . ' ' . $data['color'];
        $slug = Str::slug($string, '-');
        
        $newSlug = $slug;
        $counter = 1;
        $productCount = Product::where('slug', $slug)->count();

        while($productCount == 1) {

            if ($slug == $oldSlug) {
                return $slug;
            }

            $slug = $newSlug . "-" . $counter;            
            $productCount = Product::where('slug', $slug)->count();
            $counter++;
        }

        return $slug;
    }

    private function getColors() {
        $distinctColors = Product::select('color')->distinct()->get();
        $colors = [];
        foreach ($distinctColors as $item) {
            $colors[] = $item->color;
        }
        return $colors;
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
        $genders = Product::genders();
        $seasons = Season::all();
        $colors = $this->getColors();        

        return view('admin.products.create', 
            compact('anime', 'categories', 'genders', 'seasons', 'colors'));
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
        $request->validate($this->rules);
        
        $newProduct = new Product();
        $data['slug'] = $this->createSlug($data);
        $anime = Anime::find($data['anime_id'])->name;
        $data['prod_group'] = Str::slug($anime . ' ' . $data['name'], '-');
        
        if (array_key_exists('thumb', $data)) {
            $data['thumb'] = Storage::disk('public')->put('products/thumbnails', $data['thumb']);
        }        
        
        // dd($data);
        $newProduct->fill($data);
        $newProduct->save();
        
        if (array_key_exists('prodImgs', $data)) {
            foreach ($data['prodImgs'] as $prodImg) {
                $path = Storage::disk('public')->put('products/imgs/' . $newProduct->id, $prodImg);                
                ProdImg::create(['product_id' => $newProduct->id, 'path' => $path]);
            }
        }

        if (array_key_exists('categories', $data)) {
            $newProduct->categories()->attach($data['categories']);
        }

        return redirect()
            ->route('admin.products.show', $newProduct->id)
            ->with('created', Product::fullName($newProduct));
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
        $genders = Product::genders();
        $seasons = Season::all();
        $fullName = Product::fullName($product);
        $colors = $this->getColors();
         

        return view('admin.products.edit', 
            compact('product','anime', 'categories', 'genders', 'seasons', 'fullName', 'colors'));
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
        $request->validate($this->rules);
        $data['slug'] = $this->createSlug($data, $product->slug);
        $anime = Anime::find($data['anime_id'])->name;
        $data['prod_group'] = Str::slug($anime . ' ' . $data['name'], '-');;

        //replace & delete thumbnail
        if (array_key_exists('thumb', $data)) {            
            if ($product->thumb){
                Storage::delete($product->thumb);
            }
            $data['thumb'] = Storage::disk('public')->put ('products/thumbnails', $data['thumb']);
        }

        //replace & delete product imgs
        if (array_key_exists('prodImgs', $data)) {
            foreach ($data['prodImgs'] as $prodImg) {
                $path = Storage::disk('public')->put('products/imgs/' . $product->id, $prodImg);                
                ProdImg::create(['product_id' => $product->id, 'path' => $path]);
            }
        }

        //delete thumb checkbox
        if (array_key_exists('delete-thumb', $data)) {
            if($data['delete-thumb'] == 'on') {
                $data['thumb'] = null;
                Storage::delete($product->thumb);
            }
        }
        
        //delete product imgs checkboxes
        if (array_key_exists('delete-imgs', $data)) {
            foreach ($data['delete-imgs'] as $imgCheck) {
                $img = ProdImg::find($imgCheck);
                Storage::delete($img->path);
                $img->delete();
            }

            //delete empty folder
            $imgsCount = ProdImg::where('product_id', $product->id)->count(); 
            if($imgsCount == 0) {
                Storage::deleteDirectory('products/imgs/' . $product->id);
            }
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
            ->with('updated', Product::fullName($product));
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

        if ($product->prodImgs) {
            foreach ($product->prodImgs as $prodImg) {
                Storage::delete($prodImg->path);
            }
        }            

        $fullName = Product::fullName($product);
        $product->delete();

        //delete empty folder
        $imgsCount = ProdImg::where('product_id', $product->id)->count();
        if($imgsCount == 0) {
            Storage::deleteDirectory('products/imgs/' . $product->id);
        }
        

        return redirect()
            ->route('admin.products.index')
            ->with('deleted', $fullName);
    }
}
