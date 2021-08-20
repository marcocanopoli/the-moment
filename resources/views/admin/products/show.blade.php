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

            <div class="prod-show d-flex"> 

                {{-- Product images --}}
                <div class="prod-imgs-col d-flex flex-column me-4">
                    @foreach ($product->prodImgs as $img)
                    <img src="{{ asset('storage/' . $img->path)}}" alt="Product image" class="prod-img mb-3">
                    @endforeach
                </div>
                {{-- /Product images --}}

                {{-- Product info --}}
                <div class="d-flex flex-column">                    
                    {{-- Top --}}
                    <div class="details d-flex">
                        {{-- Left --}}
                        <div class="left d-flex me-4">
                            <img src="{{ asset('storage/' . $product->thumb) }}" class="thumb align-self-start" alt="Product thumbnail">
                        </div>
                        {{-- /Left --}}

                        {{-- Right --}}
                        <div class="right">
                            <a class="btn btn-primary me-3" href="{{ route('admin.products.edit', $product->id) }}">EDIT PRODUCT</a>
                            <a class="btn btn-warning me-2" href="{{ route('admin.variants.index', $product->id) }}">SHOW VARIANTS</a>
                            <a class="btn btn-success" href="{{ route('admin.products.index') }}">ALL PRODUCTS</a>
                            <h2 class="mt-3">Product ID: {{ $product->id }}</h2>
                            <h1>Name: {{ $product->name }}</h1>
                            <h3>Anime: {{ $product->anime->name }}</h3>
                            <h4>Slug: {{ $product->slug }}</h4>
                            <h4>Group: {{ $product->prod_group }}</h4>
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
                            <h2 class="text-primary">&euro; {{ $product->price }}</h2>
                        </div> 
                        {{-- /Right --}}
                        
                    </div>
                    {{-- /Top --}}
                    
                    {{-- Bottom Variants --}}
                    <div class="variants d-flex mb-3 mt-5 flex-wrap">
                        @foreach ($product->variants as $variant)
                        <div class="variant p-3 me-3">
                            <h4>TG: <span>{{ $variant->size }}</span></h4>
                            <h5>SKU: <span>{{ $variant->sku }}</span></h5>
                            <h5>Discount: <span>{{ $variant->discount }}&percnt;</span></h5>
                            <h5>Available: <span>{{ $variant->availability }}</span></h5>
                            <h5>Stock: <span>{{ $variant->stock }}</span></h5>
                            <a class="btn btn-primary" 
                            href="{{ route('admin.variants.edit', [$product->id, $variant->id]) }}"
                            >EDIT VARIANT</a>
                        </div>
                        @endforeach
                    </div>
                    {{-- /Bottom Variants --}}
                    
                </div>
                {{-- Product /info --}}

            </div>            
        </div>
    </div>
@endsection