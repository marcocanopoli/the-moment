@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-3">New: <span class="text-info">Category</span></h1>

        <form class="mt-3" action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Name --}}            
            <div class="mb-3">
                <label for="name" class="form-label">Category name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="T-shirt" value="{{ old('name') }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            {{-- /Name --}}  

            
            {{-- Description --}}
            <div class="mb-3">
                <label for="desc" class="form-label">Description</label>
                <textarea type="text" rows="5" class="form-control @error('desc') is-invalid @enderror" id="desc" name="desc">{{ old('desc') }}</textarea>
                @error('desc')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            {{-- /Description --}}
            
            {{-- Thumbnail --}}
            <div class="mb-3">
                <label for="thumb" class="form-label">Thumbnail (5MB Max)</label>
                <input class="form-control my-file-input @error('thumb') is-invalid @enderror" type="file" id="thumb" name="thumb">
                @error('thumb')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            {{-- /Thumbnail --}}

            <button type="submit" class="btn btn-success">ADD CATEGORY</button>
        </form>        
    </div>
@endsection