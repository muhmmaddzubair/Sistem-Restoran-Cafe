<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Aturan validasi dipakai bersama oleh store() dan update().
     */
    private function rules(): array
    {
        return [
            'kategori'  => 'required|string|max:100',
            'nama_item' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga'     => 'required|integer|min:0',
            'halal'     => 'required|boolean',
            'alergen'   => 'nullable|string|max:255',
            'foto'      => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];
    }

    // READ: daftar menu + daftar pesanan
    public function index()
    {
        $menus  = Menu::latest()->get();
        $orders = Order::with('menu')->latest()->get();

        return view('menus.index', compact('menus', 'orders'));
    }

    // Form tambah menu
    public function create()
    {
        return view('menus.create', ['menu' => new Menu()]);
    }

    // CREATE: simpan menu baru
    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        $data = collect($validated)->except('foto')->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('menus', 'public');
        }

        Menu::create($data);

        return redirect()->route('menus.index')
            ->with('success', 'Menu berhasil ditambahkan!');
    }

    // READ: detail satu menu
    public function show(Menu $menu)
    {
        return view('menus.show', compact('menu'));
    }

    // Form edit menu
    public function edit(Menu $menu)
    {
        return view('menus.edit', compact('menu'));
    }

    // UPDATE: simpan perubahan
    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate($this->rules());

        $data = collect($validated)->except('foto')->all();

        if ($request->hasFile('foto')) {
            // hapus foto lama supaya storage tidak menumpuk
            if ($menu->foto) {
                Storage::disk('public')->delete($menu->foto);
            }
            $data['foto'] = $request->file('foto')->store('menus', 'public');
        }

        $menu->update($data);

        return redirect()->route('menus.index')
            ->with('success', 'Menu berhasil diperbarui!');
    }

    // DELETE: hapus menu (foto dulu, baru datanya)
    public function destroy(Menu $menu)
    {
        if ($menu->foto) {
            Storage::disk('public')->delete($menu->foto);
        }

        $menu->delete();

        return redirect()->route('menus.index')
            ->with('success', 'Menu berhasil dihapus!');
    }
}