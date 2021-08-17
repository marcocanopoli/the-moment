@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="my-4">Editing: <span class="text-info">{{ $anime->name }}</span></h1>

        <form action="{{ route('admin.anime.update', $anime->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            {{-- Name --}}            
            <div class="mb-3">
                <label for="name" class="form-label">Anime name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $anime->name) }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            {{-- /Name --}}  
            
            <button type="submit" class="btn btn-success">CONFIRM EDIT</button>
            {{-- <a class="btn btn-primary ml-2" href="{{ route('admin.products.index') }}">ALL PRODUCTS</a> --}}

        </form>        
    </div>
@endsection