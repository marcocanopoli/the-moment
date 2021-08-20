@extends('layouts.app')
@section('content')
    <div class="container">
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
        <h1 class="mb-3">New: <span class="text-info">Product</span></h1>

        <form class="mt-3" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Name --}}            
            <div class="mb-3">
                <label for="name" class="form-label">Product name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Classic T-shirt" value="{{ old('name') }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            {{-- /Name --}}            

            {{-- Thumbnail --}}
            <div class="mb-3">
                <label for="thumb" class="form-label">Thumbnail (5MB Max)</label>
                <input class="form-control my-file-input @error('thumb') is-invalid @enderror" type="file" id="thumb" name="thumb">
                @error('thumb')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            {{-- /Thumbnail --}}

            {{-- Product Images --}}
            <div class="mb-3">
                <label for="prodImgs" class="form-label">Product Images (5MB Max Each)</label>
                <input class="form-control my-file-input @error('prodImgs') is-invalid @enderror" type="file" id="prodImgs" name="prodImgs[]" multiple>
                @foreach ($errors->get('prodImgs.*') as $index => $error)
                    <h5 class="mt-2">File {{ intval(explode('.', $index)[1]) + 1 }}</h5> 
                    @foreach($error as $message)
                        <small class="text-danger">{{ $message }}</small><br>
                    @endforeach
                @endforeach
            </div>
            {{-- /Product Images  --}}

            {{-- Anime --}}
            <div class="mb-3">
                <label for="anime_id" class="form-label">Anime</label>
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <select class="form-select @error('anime_id') is-invalid @enderror" name="anime_id" id="anime_id">
                            <option selected disabled>-- Select anime --</option>
                            @foreach ($anime as $item)
                            <option value="{{ $item->id }}" {{ (old('anime_id') ==  $item->id ) ? "selected" : "" }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('anime_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror 
                    </div>

                    <a href="{{ route('admin.anime.create') }}" 
                        class="btn btn-primary ms-4 align-self-start"
                        onclick="return confirm('You will be redirected to creation page, changes will not be saved. Are you sure?')"
                        >ADD ANIME</a>
                </div>
            </div>            
            {{-- /Anime --}}

            {{-- Season --}}
            <div class="mb-3">
                <label for="season_id" class="form-label">Season</label>
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <select class="form-select @error('season_id') is-invalid @enderror" name="season_id" id="season_id">
                            <option selected disabled>-- Select season --</option>
                            @foreach ($seasons as $season)
                            <option value="{{ $season->id }}" {{ (old('season_id') ==  $season->id  ) ? "selected" : "" }}>{{ $season->name  }}</option>
                            @endforeach
                        </select>
                        @error('season_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <a href="{{ route('admin.seasons.create') }}" 
                    class="btn btn-primary ms-4 align-self-start"                    
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
                            <input class="form-check-input" type="checkbox" value="{{ $category->id }}" id="cat-{{ $category->id }}" name="categories[]"
                            {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="cat-{{ $category->id }}">
                                {{ $category->name }}
                            </label>
                        </div>                    
                        @endforeach
                        @error('categories')
                            <br><small class="text-danger">{{ $message }}</small>
                        @enderror
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
                <input type="text" class="form-control @error('color') is-invalid @enderror" 
                id="color" name="color" placeholder="Double click to view list, type in to search" 
                value="{{ old('color') }}"
                list="colors">
                <datalist id="colors">
                    @foreach ($colors as $color)
                        <option value="{{ $color }}">{{ $color }}</option>                            
                    @endforeach
                </datalist>
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
                    <option value="{{ $gender }}" {{ (old('gender') ==  $gender ) ? "selected" : "" }}>{{ $gender }}</option>
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
                <input type="number" min="0" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="1.00" value="{{ old('price') }}">
                @error('price')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            {{-- /Price --}}
            
            {{-- Description --}}
            <div class="mb-3">
                <label for="desc" class="form-label">Description</label>
                <textarea type="text" rows="5" class="form-control @error('desc') is-invalid @enderror" id="desc" name="desc">{{ old('desc') }}</textarea>
                @error('desc')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            {{-- /Description --}}
            
            <button type="submit" class="btn btn-success">ADD PRODUCT</button>

        </form>        
    </div>
@endsection