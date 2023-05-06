@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center">
                <div class="card-header">{{ __('Selamat Datang') }}</div>

                <div class="card-body">
                    <h1>{{ __('Selamat Datang di Aplikasi Sistem Informasi Kelahiran Penduduk') }}</h1>
                    
                    <img alt="" height="300px" class="my-4" src="{{ env('APP_LOGO', 'https://picsum.photos/id/26/367/267') }}" />
                    <h3 class="my-4">Kecamatan {{ env('APP_KECAMATAN') }} Kabupaten {{ env('APP_KABUPATEN') }} </h3>
                    @guest
                    <p>{{ __('Silahkan Login untuk melanjutkan') }}</p>
                    @endguest

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
