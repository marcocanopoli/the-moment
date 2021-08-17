@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
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

            {{-- Anime --}}
            <div class="mb-3">
                <label for="anime_id" class="form-label">Anime</label>
                <div class="d-flex">
                    <select class="form-select w-auto flex-grow-1 @error('anime_id') is-invalid @enderror" name="anime_id" id="anime_id">
                        <option selected disabled>-- Select anime --</option>
                        @foreach ($anime as $item)
                        <option value="{{ $item->id }}" {{ (old('anime_id') ==  $item->id ) ? "selected" : "" }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                    
                    <a href="" class="btn btn-primary ms-4">ADD ANIME</a>
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
                        <option value="{{ $season->id }}" {{ (old('season_id') ==  $season->id  ) ? "selected" : "" }}>{{ $season->name  }}</option>
                        @endforeach
                    </select>
                    @error('season_id')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                    
                    <a href="" class="btn btn-primary ms-4">ADD SEASON</a>
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
                    </div>
                    <a href="" class="btn btn-primary">ADD CATEGORY</a>
                </div>               
            </div>
            {{-- /Categories --}}

            {{-- Color --}}
            <div class="mb-3">
                <label for="color" class="form-label">Color</label>
                <input type="text" class="form-control @error('color') is-invalid @enderror" id="color" name="color" placeholder="Black" value="{{ old('color') }}">
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
                <input type="number" min="0.10" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="1.00" value="{{ old('price') }}">
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
            {{-- <a class="btn btn-primary ml-2" href="{{ route('admin.products.index') }}">ALL PRODUCTS</a> --}}

        </form>        
    </div>
@endsection