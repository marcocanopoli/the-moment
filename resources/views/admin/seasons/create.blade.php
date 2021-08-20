@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-3">New: <span class="text-info">Season</span></h1>

        <form class="mt-3" action="{{ route('admin.seasons.store') }}" method="POST">
            @csrf

            {{-- Name --}}            
            <div class="mb-3">
                <label for="name" class="form-label">Season name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="SS20" value="{{ old('name') }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            {{-- /Name --}}  
            
            <button type="submit" class="btn btn-success">ADD SEASON</button>
        </form>        
    </div>
@endsection