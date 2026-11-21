<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['kategori' => 'Coffee',  'nama_item' => 'Cafe Latte',   'deskripsi' => 'Espresso dengan campuran susu steamed yang lembut', 'harga' => 25000, 'halal' => true, 'alergen' => 'Susu'],
            ['kategori' => 'Matcha',  'nama_item' => 'Matcha Latte', 'deskripsi' => 'Matcha dengan campuran susu steamed yang lembut',   'harga' => 30000, 'halal' => true, 'alergen' => 'Susu'],
            ['kategori' => 'Makanan', 'nama_item' => 'Donat',        'deskripsi' => 'Kue donat kentang yang lembut dan manis',            'harga' => 10000, 'halal' => true, 'alergen' => 'Gluten'],
            ['kategori' => 'Coffee',  'nama_item' => 'Cappuccino',   'deskripsi' => 'Espresso dengan susu steamed dan foam susu',         'harga' => 25000, 'halal' => true, 'alergen' => 'Susu'],
        ];

        foreach ($items as $item) {
            Menu::create($item);
        }
    }
}