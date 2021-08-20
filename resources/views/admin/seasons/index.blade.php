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

        <a class="btn btn-primary" href="{{ route('admin.seasons.create') }}">NEW SEASON</a>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($seasons as $season)
                    <tr>
                        <td>{{ $season->id }}</td>
                        <td>{{ $season->name }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('admin.seasons.edit', $season->id) }}">EDIT</a>
                        </td>
                        <td>
                            <form action="{{ route('admin.seasons.destroy', $season->id) }}" 
                                onsubmit="return confirm('Do you want to delete \'{{ $season->name }}\' ?')"
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
        <div class="pagination d-flex justify-content-center pt-4">{{ $seasons->links() }}</div>
    </div>
    
@endsection