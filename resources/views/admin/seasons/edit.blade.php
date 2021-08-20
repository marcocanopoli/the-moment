@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-3">Editing: <span class="text-info">{{ $season->name }}</span></h1>

        <form class="mt-3" action="{{ route('admin.seasons.update', $season->id) }}" method="POST">
            @csrf
            @method('PATCH')

            {{-- Name --}}            
            <div class="mb-3">
                <label for="name" class="form-label">Season name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $season->name) }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            {{-- /Name --}}  
            
            <button type="submit" class="btn btn-success">CONFIRM EDIT</button>
        </form>        
    </div>
@endsection