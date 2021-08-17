@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="{{ route('admin.anime.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Name --}}            
            <div class="mb-3">
                <label for="name" class="form-label">Anime name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Dragonball Z" value="{{ old('name') }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            {{-- /Name --}}  
            
            <button type="submit" class="btn btn-success">ADD ANIME</button>
            {{-- <a class="btn btn-primary ml-2" href="{{ route('admin.products.index') }}">ALL PRODUCTS</a> --}}

        </form>        
    </div>
@endsection