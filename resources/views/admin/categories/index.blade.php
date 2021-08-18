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

        <a class="btn btn-primary my-4" href="{{ route('admin.categories.create') }}">NEW CATEGORY</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Thumbnail</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Description</th>
                    <th colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>
                            {{-- <img src="{{ asset('storage/' . $category->thumb) }}" alt="{{ $category->name }}-thumbnail"> --}}
                            <img style="height: 50px; width: 50px; object-fit: cover;" src="{{ $category->thumb }}" alt="{{ $category->name }}-thumbnail">
                        </td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->desc }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('admin.categories.edit', $category->id) }}">EDIT</a>
                        </td>
                        <td>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" 
                                onsubmit="return confirm('Do you want to delete \'{{ $category->name }}\' ?')"
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
        <div class="pagination d-flex justify-content-center pt-4">{{ $categories->links() }}</div>
    </div>
    
@endsection