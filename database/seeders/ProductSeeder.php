<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'category' => 'Pakaian Pria',
                'name'     => 'Kaos Polos Premium',
                'price'    => 85000,
                'stock'    => 50,
                'description' => 'Kaos polos berbahan cotton combed 30s, nyaman dipakai sehari-hari.',
            ],
            [
                'category' => 'Pakaian Pria',
                'name'     => 'Kemeja Casual Slim Fit',
                'price'    => 175000,
                'stock'    => 30,
                'description' => 'Kemeja casual slim fit cocok untuk acara santai maupun semi formal.',
            ],
            [
                'category' => 'Pakaian Wanita',
                'name'     => 'Dress Floral Cantik',
                'price'    => 195000,
                'stock'    => 25,
                'description' => 'Dress floral berbahan katun ringan, cocok untuk acara casual.',
            ],
            [
                'category' => 'Pakaian Wanita',
                'name'     => 'Blouse Wanita Elegan',
                'price'    => 145000,
                'stock'    => 35,
                'description' => 'Blouse wanita berbahan sifon, nyaman dan elegan.',
            ],
            [
                'category' => 'Sepatu',
                'name'     => 'Sneakers Casual Pria',
                'price'    => 350000,
                'stock'    => 20,
                'description' => 'Sneakers casual pria dengan sol anti-slip, cocok untuk aktivitas sehari-hari.',
            ],
            [
                'category' => 'Sepatu',
                'name'     => 'Heels Wanita Cantik',
                'price'    => 280000,
                'stock'    => 15,
                'description' => 'Heels wanita dengan tinggi 5cm, nyaman dipakai seharian.',
            ],
            [
                'category' => 'Tas',
                'name'     => 'Tas Ransel Laptop',
                'price'    => 425000,
                'stock'    => 18,
                'description' => 'Tas ransel dengan kompartemen laptop hingga 15 inch, anti air.',
            ],
            [
                'category' => 'Tas',
                'name'     => 'Handbag Wanita Mini',
                'price'    => 235000,
                'stock'    => 22,
                'description' => 'Handbag wanita mini berbahan kulit sintetis premium.',
            ],
            [
                'category' => 'Aksesoris',
                'name'     => 'Jam Tangan Casual',
                'price'    => 315000,
                'stock'    => 12,
                'description' => 'Jam tangan casual dengan tali kulit, tahan air hingga 30 meter.',
            ],
            [
                'category' => 'Elektronik',
                'name'     => 'Earphone Bluetooth',
                'price'    => 185000,
                'stock'    => 40,
                'description' => 'Earphone bluetooth dengan baterai tahan 6 jam, suara jernih.',
            ],
        ];

        foreach ($products as $data) {
            $category = Category::where('name', $data['category'])->first();

            Product::create([
                'category_id' => $category->id,
                'name'        => $data['name'],
                'slug'        => Str::slug($data['name']),
                'price'       => $data['price'],
                'stock'       => $data['stock'],
                'description' => $data['description'],
                'is_active'   => true,
            ]);
        }
    }
}