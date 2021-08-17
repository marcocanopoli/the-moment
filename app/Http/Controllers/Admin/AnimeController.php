<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Anime;

class AnimeController extends Controller
{
    private $validation = [
        'name' => 'unique:anime,name'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anime_list = Anime::paginate(20);
        return view('admin.anime.index', compact('anime_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.anime.create');
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
        $newAnime = new Anime();
        $newAnime->fill($data);
        $newAnime->save();

        return redirect()
            ->route('admin.anime.index')
            ->with('created', $newAnime->name);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Anime $anime)
    {
        return view('admin.anime.edit', compact('anime'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Anime $anime)
    {
        $data = $request->all();
        $request->validate($this->validation);
        $anime->update($data);

        return redirect()
            ->route('admin.anime.index')
            ->with('updated', $anime->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Anime $anime)
    {
        $anime->delete();

        return redirect()
            ->route('admin.anime.index')
            ->with('deleted', $anime->name);
    }
}
