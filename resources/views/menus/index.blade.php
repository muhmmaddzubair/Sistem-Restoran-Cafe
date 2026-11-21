
@extends('layouts.app')

@section('title', 'Buku Menu Cafe')

@section('content')
    <h1>Buku Menu Cafe</h1>
    <p class="subtitle">Menu cafe yang berisi makanan &amp; minuman</p>

    @if (session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <div class="toolbar">
        <span></span>

        @can('manage-menu')
            <a href="{{ route('menus.create') }}" class="btn">
                + Tambah Menu
            </a>
        @endcan
    </div>

    {{-- Tabel Buku Menu --}}
    <table>
        <thead>
            <tr>
                <th>Kategori</th>
                <th>Foto</th>
                <th>Nama Item</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Halal</th>
                <th>Alergen</th>
                <th>Catatan Pesanan</th>
                <th>Kelola</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($menus as $menu)
                <tr>
                    <td>
                        <strong>{{ $menu->kategori }}</strong>
                    </td>

                    <td>
                        @if ($menu->foto)
                            <img
                                src="{{ asset('storage/' . $menu->foto) }}"
                                alt="{{ $menu->nama_item }}"
                                class="thumb"
                            >
                        @else
                            -
                        @endif
                    </td>

                    <td>
                        <strong>{{ $menu->nama_item }}</strong>
                    </td>

                    <td>{{ $menu->deskripsi }}</td>

                    <td>
                        <strong>
                            Rp{{ number_format($menu->harga, 0, ',', '.') }}
                        </strong>
                    </td>

                    <td>{{ $menu->halal ? 'Ya' : 'Tidak' }}</td>

                    <td>{{ $menu->alergen ?: '-' }}</td>

                    {{-- Form Pesanan --}}
                    <td>
                        <form action="{{ route('orders.store', $menu) }}" method="POST">
                            @csrf

                            <input
                                type="text"
                                name="catatan"
                                placeholder="Contoh: less sugar"
                                maxlength="255"
                            >

                            <button
                                type="submit"
                                class="btn"
                                style="margin-top:10px"
                            >
                                Pesan
                            </button>
                        </form>
                    </td>

                    {{-- Kelola Menu --}}
                    <td>
                        <div class="actions">

                            <a
                                href="{{ route('menus.show', $menu) }}"
                                class="btn btn-light"
                            >
                                Detail
                            </a>

                            @can('manage-menu')
                                <a
                                    href="{{ route('menus.edit', $menu) }}"
                                    class="btn btn-light"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('menus.destroy', $menu) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus menu ini?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger">
                                        Hapus
                                    </button>
                                </form>
                            @endcan

                        </div>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="9" class="center">
                        Belum ada menu.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>


    {{-- Daftar Pesanan --}}
    <h2>Daftar Pesanan</h2>

    <table>
        <thead>
            <tr>
                <th style="width:80px">No</th>
                <th>Nama Menu</th>
                <th>Catatan</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        {{ $order->menu->nama_item ?? 'Menu tidak ditemukan' }}
                    </td>

                    <td>
                        {{ $order->catatan ?: '-' }}
                    </td>

                    <td>
                        @can('delete-order')
                            <form
                                action="{{ route('orders.destroy', $order) }}"
                                method="POST"
                                onsubmit="return confirm('Hapus pesanan ini?')"
                            >
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">
                                    Hapus
                                </button>
                            </form>
                        @else
                            -
                        @endcan
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="4" class="center">
                        Belum ada pesanan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection
