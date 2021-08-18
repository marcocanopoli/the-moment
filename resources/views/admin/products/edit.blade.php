@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="my-4">Editing: <span class="text-info">{{ $fullName }}</span></h1>
        {{-- @if ($errors->any())
            @dd($errors);
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            {{-- Name --}}            
            <div class="mb-3">
                <label for="name" class="form-label">Product name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Classic T-shirt" value="{{ old('name', $product->name) }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            {{-- /Name --}}            

            {{-- Images --}}
            <div class="mb-3 d-flex">

                {{-- Thumbnail --}}
                <div class="me-3 prod-edit-left d-flex flex-column">
                    <label class="form-label">Current thumbnail</label>
                    <div class="flex-grow-1">
                        @if ($product->thumb)
                            <img class="prod-edit-thumb d-block mb-3" src="{{ asset('storage/' . $product->thumb) }}" alt="">
                        @endif
                    </div>

                    <div class="d-flex">

                        <div>
                            <label for="thumb" class="form-label">Thumbnail (5MB Max)</label>
                            <input class="form-control my-file-input @error('thumb') is-invalid @enderror" type="file" id="thumb" name="thumb">
                            @error('thumb')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="align-self-end ms-3">
                            <div class="form-check form-check-inline"> 
                                <input class="form-check-input" type="checkbox" id="delete-thumb" name ="delete-thumb">
                                <label class="form-check-label" for="delete-thumb">Delete thumbnail</label>
                            </div>
                        </div>

                    </div>
                </div>
                {{-- /Thumbnail --}}
                
                {{-- Product Images --}}
                <div class="prod-edit-right d-flex flex-column">

                    <label class="form-label">Current product images</label>
                    <div class="d-flex flex-wrap flex-grow-1">
                        @foreach ($product->prodImgs as $img)
                        <div>
                            <img src="{{ asset('storage/' . $img->path)}}" alt="Product-img-{{ $img->id }}" class="prod-edit-img mb-2 me-3 d-block">
                            <div class="form-check form-check-inline d-flex justify-content-center"> 
                                <input class="form-check-input me-2" type="checkbox" id="delete-img-{{ $img->id }}" name ="delete-imgs[]" value="{{ $img->id }}">
                                <label class="form-check-label" for="delete-img-{{ $img->id }}">Delete</label>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div>
                        <label for="prod_imgs" class="form-label">Product Images (5MB Max Each)</label>
                        <input class="form-control my-file-input @error('prod_imgs.*') is-invalid @enderror" type="file" id="prod_imgs" name="prod_imgs[]" multiple>
                        @foreach ($errors->get('prod_imgs.*') as $index => $error)
                            <h5 class="mt-2">File {{ intval(explode('.', $index)[1]) + 1 }}</h5> 
                            @foreach($error as $message)
                                <small class="text-danger">{{ $message }}</small><br>
                            @endforeach
                        @endforeach
                    </div>

                </div>
                {{-- /Product Images --}}

            </div>
            {{-- /Images --}}

            {{-- Anime --}}
            <div class="mb-3">
                <label for="anime_id" class="form-label">Anime</label>
                <div class="d-flex">
                    <select class="form-select w-auto flex-grow-1 @error('anime_id') is-invalid @enderror" name="anime_id" id="anime_id">
                        <option selected disabled>-- Select anime --</option>
                        @foreach ($anime as $item)
                        <option value="{{ $item->id }}" {{ (old('anime_id', $product->anime->id) ==  $item->id ) ? "selected" : "" }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                    
                    <a href="{{ route('admin.anime.create') }}" 
                        class="btn btn-primary ms-4"
                        onclick="return confirm('You will be redirected to creation page, changes will not be saved. Are you sure?')"
                        >ADD ANIME</a>
                </div>
                @error('anime_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>            
            {{-- /Anime --}}

            {{-- Season --}}
            <div class="mb-3">
                <label for="season_id" class="form-label">Season</label>
                <div class="d-flex">
                    <select class="form-select w-auto flex-grow-1" name="season_id" id="season_id">
                        <option selected value="null">-- Select season --</option>
                        @foreach ($seasons as $season)
                        <option value="{{ $season->id }}" {{ (old('season_id', $product->season->id) ==  $season->id  ) ? "selected" : "" }}>{{ $season->name  }}</option>
                        @endforeach
                    </select>
                    @error('season_id')
                         <small class="text-danger">{{ $message }}</small>
                    @enderror
                    
                    <a href="{{ route('admin.seasons.create') }}" 
                    class="btn btn-primary ms-4"                    
                    onclick="return confirm('You will be redirected to creation page, changes will not be saved. Are you sure?')"
                    >ADD SEASON</a>
                </div>
            </div>
            {{-- /Season --}}
            
            {{-- Categories --}}
            <div class="mb-3">
                <label class="form-label d-block">Categories</label>
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        @foreach ($categories as $category)
                        <div class="form-check d-inline-block me-2">
                            @if ($errors->any())
                                <input class="form-check-input" type="checkbox" value="{{ $category->id }}" id="cat-{{ $category->id }}" name="categories[]"
                                {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}>                                
                            @else
                                <input class="form-check-input" type="checkbox" value="{{ $category->id }}" id="cat-{{ $category->id }}" name="categories[]"
                                {{ $product->categories->contains($category->id) ? 'checked' : '' }}>   
                            @endif

                            <label class="form-check-label" for="cat-{{ $category->id }}">
                                {{ $category->name }}
                            </label>
                        </div>                    
                        @endforeach
                    </div>
                    <a href="{{ route('admin.categories.create') }}" 
                        class="btn btn-primary"                        
                        onclick="return confirm('You will be redirected to creation page, changes will not be saved. Are you sure?')"
                        >ADD CATEGORY</a>
                </div>               
            </div>
            {{-- /Categories --}}

            {{-- Color --}}
            <div class="mb-3">
                <label for="color" class="form-label">Color</label>
                <input type="text" class="form-control @error('color') is-invalid @enderror" id="color" name="color" placeholder="Black" value="{{ old('color', $product->color) }}">
                @error('color')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            {{-- /Color --}}
            
            {{-- Gender --}}
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-select @error('gender') is-invalid @enderror" name="gender" id="gender">
                    <option selected disabled>-- Select gender --</option>
                    @foreach ($genders as $gender)
                    <option value="{{ $gender }}" {{ (old('gender', $product->gender) ==  $gender ) ? "selected" : "" }}>{{ $gender }}</option>
                    @endforeach
                </select>
                @error('gender')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            {{-- /Gender --}}
            
            {{-- Price --}}
            <div class="mb-3">
                <label for="price" class="form-label">Price (&euro;)</label>
                <input type="number" min="0.10" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="1.00" value="{{ old('price', $product->price) }}">
                @error('price')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            {{-- /Price --}}
            
            {{-- Description --}}
            <div class="mb-3">
                <label for="desc" class="form-label">Description</label>
                <textarea type="text" rows="5" class="form-control @error('desc') is-invalid @enderror" id="desc" name="desc">{{ old('desc', $product->desc) }}</textarea>
                @error('desc')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            {{-- /Description --}}
            
            <button type="submit" class="btn btn-success">CONFIRM EDIT</button>
            {{-- <a class="btn btn-primary ml-2" href="{{ route('admin.products.index') }}">ALL PRODUCTS</a> --}}

        </form>        
    </div>
@endsection