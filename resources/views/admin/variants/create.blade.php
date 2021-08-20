@extends('layouts.app')
@section('content')
    <div class="container">
        <h2 class="d-inline">New <span class="text-primary">variant </span>for:</h2>
        <h1 class="text-info d-inline ms-4">{{ $fullName }}</h1>
        <div class="my-3">
            <h3 class="d-inline me-3 align-bottom">Product ID: <span class="text-info">{{ $product->id }}</span></h3>
            <a class="btn btn-primary me-2" href="{{ route('admin.products.show', $product->id) }}">SHOW PRODUCT</a>
            <a class="btn btn-warning me-2" href="{{ route('admin.variants.index', $product->id) }}">SHOW VARIANTS</a>
        </div>

        <form action="{{ route('admin.variants.store', $product->id) }}" method="POST">
            @csrf

            {{-- Size --}}            
            <div class="mb-3">
                <label for="size" class="form-label">Size</label>
                <input type="text" class="form-control @error('size') is-invalid @enderror" 
                        id="size" name="size" placeholder="Double click to view list, type in to search" 
                        value="{{ old('size') }}"
                        list="sizes">
                    <datalist id="sizes">
                        @foreach ($sizes as $size)
                            <option value="{{ $size }}">{{ $size }}</option>                            
                        @endforeach
                    </datalist>
                @error('size')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            {{-- /Size --}}  

            {{-- Discount --}}            
            <div class="mb-3">
                <label for="discount" class="form-label">Discount</label>
                <input type="number" step="1" min="0" max="99" class="form-control @error('discount') is-invalid @enderror" id="discount" name="discount" placeholder="0" value="{{ old('discount', 0) }}">
                @error('discount')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            {{-- /Discount --}}  

            {{-- Availability --}}            
            <div class="mb-3">
                <label for="availability" class="form-label">Availability</label>
                <input type="number" step="1" min="0" max="65535" class="form-control @error('availability') is-invalid @enderror" id="availability" name="availability" placeholder="0" value="{{ old('availability') }}">
                @error('availability')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            {{-- /Availability --}}  

            {{-- Stock --}}            
            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" step="1" min="0" max="65535" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" placeholder="0" value="{{ old('stock') }}">
                @error('stock')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            {{-- /Stock --}}  

            <button type="submit" class="btn btn-success">ADD VARIANT</button>
        </form>        
    </div>
@endsection