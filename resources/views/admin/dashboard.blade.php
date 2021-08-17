@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <span>{{ __('Hi, you are logged in') }}</span>
                    <div class="pt-4">
                        <h3>ID: {{ Auth::user()->id }}</h3>
                        <h1>{{ Auth::user()->name }}</h1>
                        <h2>{{ Auth::user()->email }}</h2>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
