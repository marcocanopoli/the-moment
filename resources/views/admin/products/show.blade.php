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

            <div class="col-md-4">
                <img src="{{ asset('storage/' . $product->thumb) }}" class="prod-show-thumb d-block mb-3" alt="Product image">
                @forelse ($product->categories as $category)
                    <span class="badge rounded-pill bg-primary">{{ $category->name }}</span>
                @empty                    
                    <span class="badge rounded-pill bg-warning">No category</span>
                @endforelse
                <p>{{ $product->desc }}</p>
                <a class="btn btn-success" href="{{ route('admin.products.index') }}">ALL PRODUCTS</a>
            </div>
            <div class="col-md-8" >
                <a class="btn btn-primary mb-3" href="{{ route('admin.products.edit', $product->id) }}">EDIT</a>
                <h2>ID: {{ $product->id }}</h2>
                <h1>{{ $product->name }}</h1>
                <h3>{{ $product->anime->name }}</h3>
                <h4>{{ $product->slug }}</h4>
                <h5>{{ $product->gender }}</h5>
                <h5>{{ $product->color }}</h5>
                <h5>{{ $product->season->name }}</h5>
                <h2>&euro; {{ $product->price }}</h2>
            </div>
        </div>
    </div>
@endsection