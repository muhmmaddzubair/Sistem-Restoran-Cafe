@extends('layouts.app')

@section('title', 'Edit Menu')

@section('content')
    <h1>Edit Menu</h1>
    <p class="subtitle">Ubah data menu</p>

    @include('menus._form')
@endsection