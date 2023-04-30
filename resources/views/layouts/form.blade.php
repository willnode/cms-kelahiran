@extends('layouts.app')

@section('content')

<main class="container" style="max-width: 1024px">
    <div class="card">
        <div class="card-body">
            @yield('form')
        </div>
    </div>
</main>

@endsection