@extends('layouts.app')

@section('title', $menu->nama_item)

@section('content')
    <h1>{{ $menu->nama_item }}</h1>
    <p class="subtitle">Detail menu</p>

    <div class="detail">
        @if ($menu->foto)
            <img src="{{ asset('storage/' . $menu->foto) }}" alt="{{ $menu->nama_item }}">
        @endif

        <p><strong>Kategori:</strong> {{ $menu->kategori }}</p>
        <p><strong>Deskripsi:</strong> {{ $menu->deskripsi }}</p>
        <p><strong>Harga:</strong> Rp{{ number_format($menu->harga, 0, ',', '.') }}</p>
        <p><strong>Halal:</strong> {{ $menu->halal ? 'Ya' : 'Tidak' }}</p>
        <p><strong>Alergen:</strong> {{ $menu->alergen ?: '-' }}</p>
        <p><strong>Dibuat:</strong> {{ $menu->created_at->format('d M Y, H:i') }}</p>
    </div>

    <br>
    <a href="{{ route('menus.index') }}" class="btn btn-light">Kembali</a>
@endsection