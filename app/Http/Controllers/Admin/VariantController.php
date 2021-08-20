<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Variant;
use App\Product;

class VariantController extends Controller
{
    private $rules = [
        'size' => 'required|max:5',
        'discount' => 'required|numeric|min:0|max:99',
        'availability' => 'required|numeric|min:1|max:65535',
        'stock' => 'required|numeric|min:1|max:65535'
    ];

    private function getSizes() {
        $distinctVariants = Variant::select('size')->distinct()->get();
        $sizes = [];
        foreach ($distinctVariants as $variant) {
            $sizes[] = $variant->size;
        }
        return $sizes;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        $variants = Variant::where('product_id', $product->id)->paginate(15);
        $fullName = Product::fullName($product);
        return view('admin.variants.index', compact('variants', 'product', 'fullName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        $sizes = $this->getSizes();
        $fullName = Product::fullName($product); 
        return view('admin.variants.create', compact('product', 'fullName', 'sizes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        $data = $request->all();
        $request->validate($this->rules);
        $data['product_id'] = $product->id;
        $data['sku'] = Variant::sku($product, $data['size']);
        Variant::create($data);

        return redirect()
            ->route('admin.variants.index', $product->id)
            ->with('created', $data['sku']);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product, Variant $variant)
    {
        $sizes = $this->getSizes();
        $fullName = Product::fullName($product); 
        return view('admin.variants.edit', compact('product', 'variant', 'fullName', 'sizes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product, Variant $variant)
    {
        $data = $request->all();
        $request->validate($this->rules);
        $data['sku'] = Variant::sku($product, $data['size'], $variant->sku);
        $variant->update($data);

        return redirect()
            ->route('admin.variants.index', $product->id)
            ->with('updated', $variant->sku);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Variant $variant)
    {   
        $variant->delete();

        return redirect()
            ->route('admin.variants.index', $product->id)
            ->with('deleted', $variant->sku);
    }
}
