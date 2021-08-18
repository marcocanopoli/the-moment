@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">

            @if (session('created'))
                <div class="alert alert-success my-alert">
                    <strong>'{{ session('created') }}'</strong> was succesfully created!
                </div>
            @elseif (session('updated'))
                <div class="alert alert-success my-alert">
                    <strong>'{{ session('updated') }}'</strong> was succesfully updated!
                </div>    
            @endif
            
            <div class="prod-show-left d-flex">
                <div class="d-flex flex-column me-3" >
                    @foreach ($product->prodImgs as $img)
                        <img src="{{ asset('storage/' . $img->path)}}" alt="" class="prod-show-img mb-3">
                    @endforeach
                </div>                    
                <img src="{{ asset('storage/' . $product->thumb) }}" class="prod-show-thumb align-self-start" alt="Product image">
            </div>                
                
            <div class="prod-show-right">
                <a class="btn btn-primary mb-3" href="{{ route('admin.products.edit', $product->id) }}">EDIT</a>
                <h2>Product ID: {{ $product->id }}</h2>
                <h1>Name: {{ $product->name }}</h1>
                <h3>Anime: {{ $product->anime->name }}</h3>
                <h4>Slug: {{ $product->slug }}</h4>
                <div class="mb-2">
                    @forelse ($product->categories as $category)
                    <span class="badge rounded-pill bg-primary">{{ $category->name }}</span>
                    @empty                    
                    <span class="badge rounded-pill bg-warning">No category</span>
                    @endforelse
                </div>
                <h5>Gender: {{ $product->gender }}</h5>
                <h5>Color: {{ $product->color }}</h5>
                <h5>Season: {{ $product->season->name }}</h5>
                <p>{{ $product->desc }}</p>
                <h2>&euro; {{ $product->price }}</h2>
                <a class="btn btn-success" href="{{ route('admin.products.index') }}">ALL PRODUCTS</a>
            </div> 
                       
        </div>
    </div>
@endsection