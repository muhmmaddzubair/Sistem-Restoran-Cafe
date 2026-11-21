@extends('layouts.app')

@section('title', 'Tambah Menu')

@section('content')
    <h1>Tambah Menu</h1>
    <p class="subtitle">Isi data menu baru</p>

    @include('menus._form')
@endsection