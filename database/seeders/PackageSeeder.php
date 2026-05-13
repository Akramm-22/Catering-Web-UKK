<?php
namespace Database\Seeders;

use App\Models\Package;
use App\Models\Category;
use App\Models\PackageItem;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $prasmanan = Category::where('slug', 'prasmanan')->first();
        $harian = Category::where('slug', 'harian')->first();
        $nasikotak = Category::where('slug', 'nasi-kotak')->first();
        $tumpeng = Category::where('slug', 'tumpeng')->first();

        $packages = [
            [
                'category_id' => $prasmanan->id,
                'name' => 'Andrawina Nusantara',
                'slug' => 'andrawina-nusantara',
                'description' => 'Paket prasmanan lengkap untuk acara formal. Mencakup 12 varian hidangan pembuka hingga penutup. Manjakan tamu Anda dengan hidangan eksklusif yang memadukan teknik memasak tradisional dengan presentasi estetika tinggi.',
                'short_description' => 'Paket prasmanan lengkap untuk acara formal dengan 12 varian hidangan.',
                'price' => 125000,
                'min_pax' => 50,
                'menu_type' => 'Prasmanan',
                'image' => 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=800',
                'rating' => 4.9,
                'review_count' => 120,
                'is_bestseller' => true,
                'badge' => 'TERLARIS',
                'items' => [
                    ['category' => 'Main Course', 'name' => 'Nasi Kuning Wangi Parahyangan', 'description' => 'Nasi kuning dimasak dengan santan murni dan rempah pilihan'],
                    ['category' => 'Protein', 'name' => 'Ayam Goreng Lengkuas', 'description' => 'Ayam kampung pilihan yang diungkep dengan parutan lengkuas garing'],
                    ['category' => 'Side Dish', 'name' => 'Sambal Goreng Ati Ampela', 'description' => 'Potongan hati ampela dengan bumbu balado merah yang gurih'],
                    ['category' => 'Vegetable', 'name' => 'Urap Sayur Segar', 'description' => 'Aneka sayuran rebus dengan kelapa parut berbumbu kencur'],
                    ['category' => 'Condiment', 'name' => 'Sambal Bajak & Kerupuk', 'description' => 'Sambal terasi goreng khas Jawa Timur dan kerupuk udang renyah'],
                ],
            ],
            [
                'category_id' => $harian->id,
                'name' => 'Rantang Sore',
                'slug' => 'rantang-sore',
                'description' => 'Cita rasa masakan rumah yang sehat dan higienis untuk makan malam keluarga.',
                'short_description' => 'Masakan rumah sehat untuk keluarga.',
                'price' => 45000,
                'min_pax' => 1,
                'menu_type' => 'Kotak',
                'image' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=800',
                'rating' => 4.7,
                'review_count' => 85,
                'badge' => 'BOX CATERING',
                'items' => [
                    ['category' => 'Main Course', 'name' => 'Nasi Putih Pulen', 'description' => 'Nasi putih premium pilihan'],
                    ['category' => 'Protein', 'name' => 'Rendang Daging Sapi', 'description' => 'Rendang autentik masak 4 jam'],
                    ['category' => 'Vegetable', 'name' => 'Sayur Lodeh', 'description' => 'Sayuran segar dalam kuah santan'],
                ],
            ],
            [
                'category_id' => $nasikotak->id,
                'name' => 'Paket Nasi Kotak Premium Nusantara',
                'slug' => 'paket-nasi-kotak-premium-nusantara',
                'description' => 'Sebuah perayaan cita rasa tradisional yang dikurasi dengan standar modern untuk momen istimewa Anda. Manjakan tamu Anda dengan hidangan eksklusif yang memadukan teknik memasak tradisional dengan presentasi estetika tinggi.',
                'short_description' => 'Nasi kotak premium untuk acara korporat dan syukuran.',
                'price' => 85000,
                'min_pax' => 20,
                'menu_type' => 'Prasmanan/Kotak',
                'image' => 'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=800',
                'rating' => 4.9,
                'review_count' => 120,
                'is_bestseller' => true,
                'badge' => 'TERPOPULER',
                'items' => [
                    ['category' => 'Main Course', 'name' => 'Nasi Kuning Wangi Parahyangan', 'description' => 'Nasi kuning dimasak dengan santan murni'],
                    ['category' => 'Protein', 'name' => 'Ayam Goreng Lengkuas', 'description' => 'Ayam kampung pilihan dengan lengkuas garing'],
                    ['category' => 'Side Dish', 'name' => 'Sambal Goreng Ati Ampela', 'description' => 'Bumbu balado merah gurih dan pedas'],
                    ['category' => 'Vegetable', 'name' => 'Urap Sayur Segar', 'description' => 'Kelapa parut berbumbu kencur harum'],
                    ['category' => 'Condiment', 'name' => 'Sambal Bajak & Kerupuk', 'description' => 'Kerupuk udang renyah khas Jawa Timur'],
                ],
            ],
            [
                'category_id' => $nasikotak->id,
                'name' => 'Segara Wangi',
                'slug' => 'segara-wangi',
                'description' => 'Olahan hasil laut segar dengan bumbu rempah autentik khas pesisir Indonesia.',
                'short_description' => 'Hasil laut segar bumbu rempah pesisir.',
                'price' => 85000,
                'min_pax' => 20,
                'menu_type' => 'Kotak',
                'image' => 'https://images.unsplash.com/photo-1512058564366-18510be2db19?w=800',
                'rating' => 4.8,
                'review_count' => 64,
                'items' => [
                    ['category' => 'Main Course', 'name' => 'Ikan Bakar Jimbaran', 'description' => 'Ikan segar dengan bumbu Jimbaran'],
                    ['category' => 'Side Dish', 'name' => 'Plecing Kangkung', 'description' => 'Kangkung dengan sambal tomat segar'],
                ],
            ],
            [
                'category_id' => $harian->id,
                'name' => 'Loka Organik',
                'slug' => 'loka-organik',
                'description' => 'Pilihan menu nabati yang menggunakan bahan-bahan organik lokal bersertifikat.',
                'short_description' => 'Menu nabati organik lokal bersertifikat.',
                'price' => 55000,
                'min_pax' => 10,
                'menu_type' => 'Kotak',
                'image' => 'https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?w=800',
                'rating' => 4.6,
                'review_count' => 38,
                'items' => [
                    ['category' => 'Main Course', 'name' => 'Nasi Merah Organik', 'description' => 'Nasi merah dari petani organik lokal'],
                    ['category' => 'Protein', 'name' => 'Tempe Orek Kecap', 'description' => 'Tempe premium dengan kecap manis'],
                ],
            ],
            [
                'category_id' => $tumpeng->id,
                'name' => 'Tumpeng Agung Nusantara',
                'slug' => 'tumpeng-agung-nusantara',
                'description' => 'Tumpeng tradisional megah untuk acara syukuran, ulang tahun, dan peringatan khusus.',
                'short_description' => 'Tumpeng tradisional untuk momen syukuran istimewa.',
                'price' => 1250000,
                'min_pax' => 10,
                'max_pax' => 15,
                'menu_type' => 'Tumpeng',
                'image' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=800',
                'rating' => 5.0,
                'review_count' => 29,
                'is_bestseller' => true,
                'items' => [
                    ['category' => 'Main Course', 'name' => 'Tumpeng Nasi Kuning', 'description' => 'Nasi kuning kerucut berlapis daun pandan'],
                    ['category' => 'Protein', 'name' => 'Ayam Ingkung Utuh', 'description' => 'Ayam kampung utuh dimasak bumbu Jawa'],
                    ['category' => 'Side Dish', 'name' => 'Perkedel Kentang', 'description' => 'Perkedel goreng renyah di luar lembut di dalam'],
                ],
            ],
            [
                'category_id' => $harian->id,
                'name' => 'Jajan Kirana',
                'slug' => 'jajan-kirana',
                'description' => 'Koleksi kudapan tradisional premium untuk menemani waktu santai atau rapat Anda.',
                'short_description' => 'Kudapan tradisional premium untuk rapat dan santai.',
                'price' => 35000,
                'min_pax' => 10,
                'menu_type' => 'Snack Box',
                'image' => 'https://images.unsplash.com/photo-1558961363-fa8fdf82db35?w=800',
                'rating' => 4.5,
                'review_count' => 52,
                'items' => [
                    ['category' => 'Snack', 'name' => 'Klepon Pandan', 'description' => 'Bola ketan pandan isi gula merah'],
                    ['category' => 'Snack', 'name' => 'Onde-onde Wijen', 'description' => 'Gorengan ketan berisi kacang hijau'],
                    ['category' => 'Minuman', 'name' => 'Wedang Jahe', 'description' => 'Minuman jahe hangat menenangkan'],
                ],
            ],
        ];

        foreach ($packages as $pkgData) {
            $items = $pkgData['items'];
            unset($pkgData['items']);

            $package = Package::updateOrCreate(
                ['slug' => $pkgData['slug']],
                $pkgData
            );

            PackageItem::where('package_id', $package->id)->delete();
            foreach ($items as $i => $item) {
                PackageItem::create([
                    'package_id' => $package->id,
                    'sort_order' => $i,
                    ...$item
                ]);
            }
        }
    }
}
