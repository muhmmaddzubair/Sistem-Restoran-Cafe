@extends('layouts.app')

@section('title', 'Akses Ditolak')

@section('content')
    <h1>403 - Akses Ditolak</h1>
    <p class="subtitle">{{ $exception->getMessage() ?: 'Anda tidak memiliki izin untuk membuka halaman ini.' }}</p>

    <a href="{{ route('menus.index') }}" class="btn">Kembali ke Menu</a>
@endsection