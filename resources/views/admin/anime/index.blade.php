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

        <a class="btn btn-primary" href="{{ route('admin.anime.create') }}">NEW ANIME</a>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th colspan="2" >Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($anime_list as $anime)
                    <tr>
                        <td>{{ $anime->id }}</td>
                        <td>{{ $anime->name }}</td>
                        {{-- <td>
                            <a class="btn btn-success" href="{{ route('admin.anime.show', $anime->id) }}">SHOW</a>
                        </td> --}}
                        <td>
                            <a class="btn btn-primary" href="{{ route('admin.anime.edit', $anime->id) }}">EDIT</a>
                        </td>
                        <td>
                            <form action="{{ route('admin.anime.destroy', $anime->id) }}" 
                                onsubmit="return confirm('Do you want to delete \'{{ $anime->name }}\' ?')"
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
        <div class="pagination d-flex justify-content-center pt-4">{{ $anime_list->links() }}</div>
    </div>
    
@endsection