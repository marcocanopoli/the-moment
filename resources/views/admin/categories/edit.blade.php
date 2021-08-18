@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="my-4">Editing: <span class="text-info">{{ $category->name }}</span></h1>

        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            {{-- Name --}}            
            <div class="mb-3">
                <label for="name" class="form-label">Category name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="T-shirt" value="{{ old('name', $category->name) }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            {{-- /Name --}}  

            
            {{-- Description --}}
            <div class="mb-3">
                <label for="desc" class="form-label">Description</label>
                <textarea type="text" rows="5" class="form-control @error('desc') is-invalid @enderror" id="desc" name="desc">{{ old('desc', $category->desc) }}</textarea>
                @error('desc')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            {{-- /Description --}}
            
            {{-- Thumbnail --}}
            <div class="mb-3">
                <label class="form-label">Current thumbnail</label>
                @if ($category->thumb)
                    <img class="d-block mb-3" src="{{ asset('storage/' . $category->thumb) }}" alt="{{ $category->name . '-thumbnail'}}">
                @endif
                <label for="thumb" class="form-label">Thumbnail (5MB Max)</label>
                <input class="form-control my-file-input @error('thumb') is-invalid @enderror" type="file" id="thumb" name="thumb">
                @error('thumb')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            {{-- /Thumbnail --}}

            <button type="submit" class="btn btn-success">CONFIRM EDIT</button>
        </form>        
    </div>
@endsection