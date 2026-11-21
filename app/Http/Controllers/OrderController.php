<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Pesan sebuah menu (dengan catatan opsional)
    public function store(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'catatan' => 'nullable|string|max:255',
        ]);

        $menu->orders()->create([
            'catatan' => $validated['catatan'] ?? null,
        ]);

        return redirect()->route('menus.index')
            ->with('success', 'Pesanan berhasil ditambahkan!');
    }

    // Hapus pesanan
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('menus.index')
            ->with('success', 'Pesanan berhasil dihapus!');
    }
    
}