@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
    <h1>Tambah User</h1>
    <p class="subtitle">Buat akun baru dan tentukan perannya</p>

    @if ($errors->any())
        <div class="alert alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST" class="form-box">
        @csrf

        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" value="{{ old('email') }}">
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <select name="role" id="role">
                @foreach (\App\Models\User::ROLES as $role)
                    <option value="{{ $role }}" @selected(old('role') === $role)>{{ ucfirst($role) }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password"
                   style="width:100%;padding:9px 10px;border:1px solid #ccc;font-size:14px">
        </div>

        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                   style="width:100%;padding:9px 10px;border:1px solid #ccc;font-size:14px">
        </div>

        <div class="actions">
            <a href="{{ route('users.index') }}" class="btn btn-light">Kembali</a>
            <button type="submit" class="btn">Simpan</button>
        </div>
    </form>
@endsection