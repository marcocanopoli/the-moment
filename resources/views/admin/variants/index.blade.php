@extends('layouts.app')
@section('content')
    <div class="container">
        @if (session('deleted'))
            <div class="alert alert-success my-alert">
                <strong>'{{ session('deleted') }}'</strong> was succesfully deleted!
            </div>            
        @elseif (session('created'))
            <div class="alert alert-success my-alert">
                <strong>'{{ session('created') }}'</strong> was succesfully created!
            </div>
        @elseif (session('updated'))
            <div class="alert alert-success my-alert">
                <strong>'{{ session('updated') }}'</strong> was succesfully updated!
            </div>
        @endif

        <h2 class="d-inline"><span class="text-primary">Variants</span> index for:</h2>
        <h1 class="text-info d-inline ms-4">{{ $fullName }}</h1>
        <h3 class="my-3">Product ID: <span class="text-info">{{ $product->id }}</span></h3>

        <a class="btn btn-warning me-2" href="{{ route('admin.variants.create', $product->id) }}">NEW VARIANT</a>
        <a class="btn btn-primary me-2" href="{{ route('admin.products.show', $product->id) }}">SHOW PRODUCT</a>
        <a class="btn btn-success" href="{{ route('admin.products.index') }}">ALL PRODUCTS</a>

        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    {{-- <th>Product ID</th>
                    <th>Anime</th>
                    <th>Product name</th> --}}
                    <th>Size</th>
                    <th>SKU</th>
                    <th>Discount</th>
                    <th>Availabilty</th>
                    <th>Stock</th>
                    <th colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($variants as $variant)
                    <tr>
                        <td>{{ $variant->id }}</td>
                        {{-- <td>{{ $variant->product->id }}</td>
                        <td>{{ $variant->product->anime->name }}</td>
                        <td>{{ $variant->product->name }}</td> --}}
                        <td>{{ $variant->size }}</td>
                        <td>{{ $variant->sku }}</td>
                        <td>{{ $variant->discount }}&percnt;</td>
                        <td>{{ $variant->availability }}</td>
                        <td>{{ $variant->stock }}</td>
                        <td>
                            <a class="btn btn-primary" 
                                href="{{ route('admin.variants.edit', [$product->id, $variant->id]) }}"
                                >EDIT</a>
                        </td>
                        <td>
                            <form action="{{ route('admin.variants.destroy', [$product->id, $variant->id]) }}"
                                onsubmit="return confirm('Do you want to delete \'{{ $variant->sku }}\' ?')"
                                method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" 
                                    class="btn btn-danger">
                                    DELETE
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination d-flex justify-content-center pt-4">{{ $variants->links() }}</div>
    </div>
    
@endsection