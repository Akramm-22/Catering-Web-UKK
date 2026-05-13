<?php
namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Semua Paket', 'slug' => 'semua-paket', 'icon' => '🍽️'],
            ['name' => 'Harian', 'slug' => 'harian', 'icon' => '🥗'],
            ['name' => 'Prasmanan', 'slug' => 'prasmanan', 'icon' => '🍛'],
            ['name' => 'Nasi Kotak', 'slug' => 'nasi-kotak', 'icon' => '📦'],
            ['name' => 'Tumpeng', 'slug' => 'tumpeng', 'icon' => '🏔️'],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(['slug' => $cat['slug']], $cat);
        }
    }
}
