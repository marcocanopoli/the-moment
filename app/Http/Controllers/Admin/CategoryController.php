<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Category;

class CategoryController extends Controller
{

    private $validation = [
        'thumb' => 'nullable|mimes:jpeg,jpg,png,bmp,gif,svg,webp|max:5120',
        'name' => 'unique:categories,name',
        'desc' => 'nullable'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(20);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
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
        $newCategory = new Category();
        $data['slug'] = Str::slug('cat ' . $data['name'], '-');

        if (array_key_exists('thumb', $data)) {
            $data['thumb'] = Storage::disk('public')->put('categories/thumbnails', $data['thumb']);        
        }

        $newCategory->fill($data);
        $newCategory->save();

        return redirect()
            ->route('admin.categories.index')
            ->with('created', $newCategory->name);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
   {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->all();
        $request->validate(
            [
                'thumb' => 'nullable|mimes:jpeg,jpg,png,bmp,gif,svg,webp|max:5120',
                'name' => Rule::unique('categories')->ignore($category->name, 'name'),
                'desc' => 'nullable'
            ]
        );

        $data['slug'] = Str::slug('cat ' . $data['name'], '-');

        //replace & delete thumbnail
        if (array_key_exists('thumb', $data)) {            
            if ($category->thumb){
                Storage::delete($category->thumb);
            }
            $data['thumb'] = Storage::disk('public')->put ('products/thumbnails', $data['thumb']);
        }

        $category->update($data);

        return redirect()
            ->route('admin.categories.index')
            ->with('updated', $category->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('deleted', $category->name);
    }
}
