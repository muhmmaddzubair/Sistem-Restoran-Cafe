@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="login-box">
        <h1>Login</h1>
        <p class="subtitle">Masuk untuk mengelola Buku Menu Cafe</p>

        @if ($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" value="{{ old('email') }}"
                       placeholder="admin@cafe.test" autofocus>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password"
                       style="width:100%;padding:9px 10px;border:1px solid #ccc;font-size:14px">
            </div>

            <div class="form-group">
                <label style="font-weight:normal">
                    <input type="checkbox" name="remember"> Ingat saya
                </label>
            </div>

            <button type="submit" class="btn">Login</button>
        </form>
    </div>
@endsection