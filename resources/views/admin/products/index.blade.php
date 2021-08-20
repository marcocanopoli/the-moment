@extends('layouts.app')
@section('content')
    <div class="container">
        @if (session('deleted'))
            <div class="alert alert-success my-alert">
                <strong>'{{ session('deleted') }}'</strong> was succesfully deleted!
            </div>            
        @endif

        <a class="btn btn-primary mb-3" href="{{ route('admin.products.create') }}">NEW PRODUCT</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Thumbnail</th>
                    <th>Categories</th>
                    <th>ID</th>
                    <th>Anime</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Color</th>
                    <th>Season</th>
                    <th>Gender</th>
                    <th>Price</th>
                    <th>Variants</th>
                    <th colspan="3" >Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td><img src="{{ asset('storage/' . $product->thumb) }}" class="prod-index-thumb" alt="Thumbnail"></td>
                        <td class="text-center">
                            @forelse ($product->categories as $category)
                                <img src="{{ asset('storage/' . $category->thumb) }}" alt="{{ $category->name }} thumb" class="prod-index-cat">
                            @empty                    
                                <span class="badge rounded-pill bg-warning">No category</span>
                            @endforelse
                        </td>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->anime->name }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->slug }}</td>
                        <td>{{ $product->color }}</td>
                        <td>{{ $product->season->name }}</td>
                        <td>{{ $product->gender }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                            <a class="btn btn-warning" href="{{ route('admin.variants.index', $product->id) }}">VARIANTS</a>
                        </td>
                        <td>
                            <a class="btn btn-success" href="{{ route('admin.products.show', $product->id) }}">SHOW</a>
                        </td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('admin.products.edit', $product->id) }}">EDIT</a>
                        </td>
                        <td>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" 
                                onsubmit="return confirm('Do you want to delete this product? ({{ $product->anime->name . ' - ' . $product->name . ' - ' . $product->color }})')"
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
        <div class="pagination d-flex justify-content-center pt-4">{{ $products->links() }}</div>
    </div>
    
@endsection