@extends('layouts.app')

@section('title', 'Kelola User')

@section('content')
    <h1>Kelola User</h1>
    <p class="subtitle">Atur siapa yang boleh login dan apa perannya</p>

    @if (session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <div class="toolbar">
        <span></span>
        <a href="{{ route('users.create') }}" class="btn">+ Tambah User</a>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width:60px">No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><strong>{{ $user->name }}</strong></td>
                    <td>{{ $user->email }}</td>
                    <td><span class="badge" style="margin:0">{{ $user->role }}</span></td>
                    <td>
                        @if ($user->is_active)
                            Aktif
                        @else
                            <span class="badge badge-off" style="margin:0">Nonaktif</span>
                        @endif
                    </td>
                    <td>
                        @if ($user->id !== auth()->id())
                            <div class="actions">
                                <form action="{{ route('users.toggle', $user) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-light">
                                        {{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                    </button>
                                </form>

                                <form action="{{ route('users.destroy', $user) }}" method="POST"
                                      onsubmit="return confirm('Hapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        @else
                            (akun Anda)
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection