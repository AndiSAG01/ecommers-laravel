<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* Pod Mod */

        Product::create([
            'name' => 'Asmodus Minikin Pod Kit',
            'slug' => 'asmodus-minikin-pod-kit-89674',
            'category_id' => 4,
            'color' => 'Hitam,Biru,Metal',
            'nicotine' => NULL,
            'price' => 390000,
            'weight' => 250,
            'qty' => 50,
            'image' => 'asmodus-minikin-pod-kit.png',
            'description' => 'Harap konfirmasi terlebih dahulu untuk ketersediaan stock barang ,, jika tidak dan stock nya kosong. akan kami kirimkan barang random.',
            'status' => 1,
        ]);

        Product::create([
            'name' => 'Dotmod Dotaio V2 Lite New Version',
            'slug' => 'dotmod-dotaio-v2-lite-new-version-20561',
            'category_id' => 4,
            'color' => 'Merah,Ungu,Clear,',
            'nicotine' => NULL,
            'price' => 875000,
            'weight' => 250,
            'qty' => 50,
            'image' => 'dotmod-dotaio-v2-lite-new-version.png',
            'description' => 'Harap konfirmasi terlebih dahulu untuk ketersediaan stock barang ,, jika tidak dan stock nya kosong. akan kami kirimkan barang random.',
            'status' => 1,
        ]);

        Product::create([
            'name' => 'Aspire Raga Aio 75W With Age RBA',
            'slug' => 'aspire-raga-aio-75w-with-age-rba-73048',
            'category_id' => 4,
            'color' => 'Hitam,Biru',
            'nicotine' => NULL,
            'price' => 1900000,
            'weight' => 250,
            'qty' => 50,
            'image' => 'aspire-raga-aio-75w-with-age-rba.png',
            'description' => 'Harap konfirmasi terlebih dahulu untuk ketersediaan stock barang ,, jika tidak dan stock nya kosong. akan kami kirimkan barang random.',
            'status' => 1,
        ]);

        Product::create([
            'name' => 'Pulse Aio V2 Kit With RBA',
            'slug' => 'pulse-aio-v2-kit-with-rba-51236',
            'category_id' => 4,
            'color' => 'Hijau,Ungu,Oren,Hitam',
            'nicotine' => NULL,
            'price' => 750000,
            'weight' => 250,
            'qty' => 50,
            'image' => 'pulse-aio-v2-kit-with-rba.png',
            'description' => 'Harap konfirmasi terlebih dahulu untuk ketersediaan stock barang ,, jika tidak dan stock nya kosong. akan kami kirimkan barang random.',
            'status' => 1,
        ]);

        Product::create([
            'name' => 'Rincoe Manto Aio Ultra With RBA',
            'slug' => 'rincoe-manto-aio-ultra-with-rba-98703',
            'category_id' => 4,
            'color' => 'Hijau,Hitam,Biru,Pink,Ungu',
            'nicotine' => NULL,
            'price' => 580000,
            'weight' => 250,
            'qty' => 50,
            'image' => 'rincoe-manto-aio-ultra-with-rba.png',
            'description' => 'Harap konfirmasi terlebih dahulu untuk ketersediaan stock barang ,, jika tidak dan stock nya kosong. akan kami kirimkan barang random.',
            'status' => 1,
        ]);

        Product::create([
            'name' => 'Rincoe Manto Aio Pro Kit',
            'slug' => 'rincoe-manto-aio-pro-kit-30498',
            'category_id' => 4,
            'color' => 'Hijau,Hitam,Biru,Pink,Ungu,Kuning',
            'nicotine' => NULL,
            'price' => 375000,
            'weight' => 250,
            'qty' => 50,
            'image' => 'rincoe-manto-aio-pro-kit.png',
            'description' => 'Harap konfirmasi terlebih dahulu untuk ketersediaan stock barang ,, jika tidak dan stock nya kosong. akan kami kirimkan barang random.',
            'status' => 1,
        ]);

        Product::create([
            'name' => 'San Aio Cyber Edition',
            'slug' => 'san-aio-cyber-edition-67021',
            'category_id' => 4,
            'color' => 'Hitam,Putih,Merah,Hijau',
            'nicotine' => NULL,
            'price' => 900000,
            'weight' => 250,
            'qty' => 50,
            'image' => 'san-aio-cyber-edition.png',
            'description' => 'Harap konfirmasi terlebih dahulu untuk ketersediaan stock barang ,, jika tidak dan stock nya kosong. akan kami kirimkan barang random.',
            'status' => 1,
        ]);

        Product::create([
            'name' => 'Blaze Aio X Mike Vapes',
            'slug' => 'blaze-aio-x-mike-vapes-45092',
            'category_id' => 4,
            'color' => 'Hitam,Metal,Merah,Biru',
            'nicotine' => NULL,
            'price' => 125000,
            'weight' => 250,
            'qty' => 50,
            'image' => 'blaze-aio-x-mike-vapes.png',
            'description' => 'Harap konfirmasi terlebih dahulu untuk ketersediaan stock barang ,, jika tidak dan stock nya kosong. akan kami kirimkan barang random.',
            'status' => 1,
        ]);

        /* Liquid */

        Product::create([
            'name' => 'Tigac Sando Cream Sandwich 60ML',
            'slug' => 'tigac-sando-cream-sandwich-60ml-18635',
            'category_id' => 3,
            'color' => NULL,
            'nicotine' => '3MG,6MG,9MG',
            'price' => 150000,
            'weight' => 150,
            'qty' => 50,
            'image' => 'tigac-sando-cream-sandwich-60ml.png',
            'description' => 'Harap konfirmasi terlebih dahulu untuk ketersediaan stock barang ,, jika tidak dan stock nya kosong. akan kami kirimkan barang random.',
            'status' => 1,
        ]);

        Product::create([
            'name' => 'Waimarie Milk Cereals 60ML',
            'slug' => 'waimarie-milk-cereals-60ml-82019',
            'category_id' => 3,
            'color' => NULL,
            'nicotine' => '3MG,6MG',
            'price' => 145000,
            'weight' => 150,
            'qty' => 50,
            'image' => 'waimarie-milk-cereals-60ml.png',
            'description' => 'Harap konfirmasi terlebih dahulu untuk ketersediaan stock barang ,, jika tidak dan stock nya kosong. akan kami kirimkan barang random.',
            'status' => 1,
        ]);

        Product::create([
            'name' => 'Toxic Berry Wonderland Dessert 60ML',
            'slug' => 'toxic-berry-wonderland-dessert-60ml-57390',
            'category_id' => 3,
            'color' => NULL,
            'nicotine' => '3MG,6MG,9MG',
            'price' => 145000,
            'weight' => 150,
            'qty' => 50,
            'image' => 'toxic-berry-wonderland-dessert-60ml.png',
            'description' => 'Harap konfirmasi terlebih dahulu untuk ketersediaan stock barang ,, jika tidak dan stock nya kosong. akan kami kirimkan barang random.',
            'status' => 1,
        ]);

        Product::create([
            'name' => 'Movi Freebase Strawberry Cream 60ML',
            'slug' => 'movi-freebase-strawberry-cream-60ml-26975',
            'category_id' => 3,
            'color' => NULL,
            'nicotine' => '3MG,6MG,9MG,12MG',
            'price' => 145000,
            'weight' => 150,
            'qty' => 50,
            'image' => 'movi-freebase-strawberry-cream-60ml.png',
            'description' => 'Harap konfirmasi terlebih dahulu untuk ketersediaan stock barang ,, jika tidak dan stock nya kosong. akan kami kirimkan barang random.',
            'status' => 1,
        ]);

        Product::create([
            'name' => 'Movi Freebase Fresh Mango 60ML',
            'slug' => 'movi-freebase-fresh-mango-60ml-94127',
            'category_id' => 3,
            'color' => NULL,
            'nicotine' => '3MG,6MG,9MG,12MG',
            'price' => 145000,
            'weight' => 150,
            'qty' => 50,
            'image' => 'movi-freebase-fresh-mango-60ml.png',
            'description' => 'Harap konfirmasi terlebih dahulu untuk ketersediaan stock barang ,, jika tidak dan stock nya kosong. akan kami kirimkan barang random.',
            'status' => 1,
        ]);

        Product::create([
            'name' => 'Movi Freebase Fresh Mango 60ML',
            'slug' => 'movi-freebase-fresh-mango-60ml-36785',
            'category_id' => 3,
            'color' => NULL,
            'nicotine' => '3MG,6MG,9MG,12MG',
            'price' => 145000,
            'weight' => 150,
            'qty' => 50,
            'image' => 'movi-freebase-fresh-mango-60ml.png',
            'description' => 'Harap konfirmasi terlebih dahulu untuk ketersediaan stock barang ,, jika tidak dan stock nya kosong. akan kami kirimkan barang random.',
            'status' => 1,
        ]);

        Product::create([
            'name' => 'Movi Freebase Fresh Apple 60ML',
            'slug' => 'movi-freebase-fresh-apple-60ml-50824',
            'category_id' => 3,
            'color' => NULL,
            'nicotine' => '3MG,6MG,9MG,12MG',
            'price' => 145000,
            'weight' => 150,
            'qty' => 50,
            'image' => 'movi-freebase-fresh-apple-60ml.png',
            'description' => 'Harap konfirmasi terlebih dahulu untuk ketersediaan stock barang ,, jika tidak dan stock nya kosong. akan kami kirimkan barang random.',
            'status' => 1,
        ]);

        Product::create([
            'name' => 'Movi Freebase Pink Beach Ice 60ML',
            'slug' => 'movi-freebase-pink-beach-ice-60ml-50824',
            'category_id' => 3,
            'color' => NULL,
            'nicotine' => '3MG,6MG,9MG,12MG',
            'price' => 145000,
            'weight' => 150,
            'qty' => 50,
            'image' => 'movi-freebase-pink-beach-ice-60ml.png',
            'description' => 'Harap konfirmasi terlebih dahulu untuk ketersediaan stock barang ,, jika tidak dan stock nya kosong. akan kami kirimkan barang random.',
            'status' => 1,
        ]);

        Product::create([
            'name' => 'Movi Freebase Es Buah 60ML',
            'slug' => 'movi-freebase-es-buah-60ml-50824',
            'category_id' => 3,
            'color' => NULL,
            'nicotine' => '3MG,6MG,9MG,12MG',
            'price' => 145000,
            'weight' => 150,
            'qty' => 50,
            'image' => 'movi-freebase-es-buah-60ml.png',
            'description' => 'Harap konfirmasi terlebih dahulu untuk ketersediaan stock barang ,, jika tidak dan stock nya kosong. akan kami kirimkan barang random.',
            'status' => 1,
        ]);

        Product::create([
            'name' => 'Movi Freebase Honeydew 60ML',
            'slug' => 'movi-freebase-honeydew-30ml-72416',
            'category_id' => 3,
            'color' => NULL,
            'nicotine' => '3MG,6MG,9MG,12MG',
            'price' => 145000,
            'weight' => 150,
            'qty' => 50,
            'image' => 'movi-freebase-honeydew-30ml.png',
            'description' => 'Harap konfirmasi terlebih dahulu untuk ketersediaan stock barang ,, jika tidak dan stock nya kosong. akan kami kirimkan barang random.',
            'status' => 1,
        ]);

        Product::create([
            'name' => 'Movi Freebase Watermelon 60ML',
            'slug' => 'movi-freebase-watermelon-30ml-95307',
            'category_id' => 3,
            'color' => NULL,
            'nicotine' => '3MG,6MG,9MG,12MG',
            'price' => 145000,
            'weight' => 150,
            'qty' => 50,
            'image' => 'movi-freebase-watermelon-30ml.png',
            'description' => 'Harap konfirmasi terlebih dahulu untuk ketersediaan stock barang ,, jika tidak dan stock nya kosong. akan kami kirimkan barang random.',
            'status' => 1,
        ]);

        Product::create([
            'name' => 'Lokaal Salt Vanilla Ice Cream 4x15ML',
            'slug' => 'lokaal-salt-vanilla-ice-cream-4x15ml-14269',
            'category_id' => 2,
            'color' => NULL,
            'nicotine' => '30MG',
            'price' => 145000,
            'weight' => 150,
            'qty' => 50,
            'image' => 'lokaal-salt-vanilla-ice-cream-4x15ml.png',
            'description' => 'Harap konfirmasi terlebih dahulu untuk ketersediaan stock barang ,, jika tidak dan stock nya kosong. akan kami kirimkan barang random.',
            'status' => 1,
        ]);

        Product::create([
            'name' => 'Lokaal Salt Strawberry 4x15ML',
            'slug' => 'lokaal-salt-strawberry-4x15ml-68103',
            'category_id' => 2,
            'color' => NULL,
            'nicotine' => '30MG',
            'price' => 145000,
            'weight' => 150,
            'qty' => 50,
            'image' => 'lokaal-salt-strawberry-4x15ml.png',
            'description' => 'Harap konfirmasi terlebih dahulu untuk ketersediaan stock barang ,, jika tidak dan stock nya kosong. akan kami kirimkan barang random.',
            'status' => 1,
        ]);

        Product::create([
            'name' => 'Lokaal Salt Mango 4x15ML',
            'slug' => 'lokaal-salt-mango-4x15ml-53921',
            'category_id' => 2,
            'color' => NULL,
            'nicotine' => '30MG',
            'price' => 145000,
            'weight' => 150,
            'qty' => 50,
            'image' => 'lokaal-salt-mango-4x15ml.png',
            'description' => 'Harap konfirmasi terlebih dahulu untuk ketersediaan stock barang ,, jika tidak dan stock nya kosong. akan kami kirimkan barang random.',
            'status' => 1,
        ]);

        Product::create([
            'name' => 'Lokaal Salt Coconut Water 4x15ML',
            'slug' => 'lokaal-salt-coconut-water-4x15ml-80764',
            'category_id' => 2,
            'color' => NULL,
            'nicotine' => '30MG',
            'price' => 145000,
            'weight' => 150,
            'qty' => 50,
            'image' => 'lokaal-salt-coconut-water-4x15ml.png',
            'description' => 'Harap konfirmasi terlebih dahulu untuk ketersediaan stock barang ,, jika tidak dan stock nya kosong. akan kami kirimkan barang random.',
            'status' => 1,
        ]);

        Product::create([
            'name' => 'Ekimo Salt Watermelon',
            'slug' => 'ekimo-salt-watermelon-30ml-28543',
            'category_id' => 2,
            'color' => NULL,
            'nicotine' => '30MG',
            'price' => 120000,
            'weight' => 150,
            'qty' => 50,
            'image' => 'ekimo-salt-watermelon-30ml.png',
            'description' => 'Harap konfirmasi terlebih dahulu untuk ketersediaan stock barang ,, jika tidak dan stock nya kosong. akan kami kirimkan barang random.',
            'status' => 1,
        ]);

        Product::create([
            'name' => 'Ekimo Salt Honeydew 30ML',
            'slug' => 'ekimo-salt-honeydew-30ml-69017',
            'category_id' => 2,
            'color' => NULL,
            'nicotine' => '30MG',
            'price' => 120000,
            'weight' => 150,
            'qty' => 50,
            'image' => 'ekimo-salt-honeydew-30ml.png',
            'description' => 'Harap konfirmasi terlebih dahulu untuk ketersediaan stock barang ,, jika tidak dan stock nya kosong. akan kami kirimkan barang random.',
            'status' => 1,
        ]);

        Product::create([
            'name' => 'Ekimo Salt Apple 30ML',
            'slug' => 'ekimo-salt-apple-30ml-43178',
            'category_id' => 2,
            'color' => NULL,
            'nicotine' => '30MG',
            'price' => 120000,
            'weight' => 150,
            'qty' => 50,
            'image' => 'ekimo-salt-apple-30ml.png',
            'description' => 'Harap konfirmasi terlebih dahulu untuk ketersediaan stock barang ,, jika tidak dan stock nya kosong. akan kami kirimkan barang random.',
            'status' => 1,
        ]);

        Product::create([
            'name' => 'Lio Salt Ice Cream Strawberry Vanilla 30ML',
            'slug' => 'lio-salt-ice-cream-strawberry-vanilla-30ml-97502',
            'category_id' => 2,
            'color' => NULL,
            'nicotine' => '30MG',
            'price' => 120000,
            'weight' => 150,
            'qty' => 50,
            'image' => 'lio-salt-ice-cream-strawberry-vanilla-30ml.png',
            'description' => 'Harap konfirmasi terlebih dahulu untuk ketersediaan stock barang ,, jika tidak dan stock nya kosong. akan kami kirimkan barang random.',
            'status' => 1,
        ]);

        Product::create([
            'name' => 'Lio Salt Caramel Butter Cream 30ML',
            'slug' => 'lio-salt-caramel-butter-cream-30ml-36782',
            'category_id' => 2,
            'color' => NULL,
            'nicotine' => '30MG',
            'price' => 120000,
            'weight' => 150,
            'qty' => 50,
            'image' => 'lio-salt-caramel-butter-cream-30ml.png',
            'description' => 'Harap konfirmasi terlebih dahulu untuk ketersediaan stock barang ,, jika tidak dan stock nya kosong. akan kami kirimkan barang random.',
            'status' => 1,
        ]);

        /* Accessories */

        Product::create([
            'name' => 'Battery Big Black DNA 18650 4000MAH 35A',
            'slug' => 'battery-big-black-dna-18650-4000mah-35a-36782',
            'category_id' => 5,
            'color' => NULL,
            'nicotine' => NULL,
            'price' => 135000,
            'weight' => 100,
            'qty' => 50,
            'image' => 'battery-big-black-dna-18650-4000mah-35a.png',
            'description' => 'Harap konfirmasi terlebih dahulu untuk ketersediaan stock barang ,, jika tidak dan stock nya kosong. akan kami kirimkan barang random.',
            'status' => 1,
        ]);

        /* Atomizer */

        Product::create([
            'name' => 'BB Bridge Mobb V Figure RBA by SXK',
            'slug' => 'bb-bridge-mobb-v-figure-rba-by-sxk-24786',
            'category_id' => 6,
            'color' => NULL,
            'nicotine' => Null,
            'price' => 350000,
            'weight' => 150,
            'qty' => 50,
            'image' => 'bb-bridge-mobb-v-figure-rba-by-sxk.png',
            'description' => 'Harap konfirmasi terlebih dahulu untuk ketersediaan stock barang ,, jika tidak dan stock nya kosong. akan kami kirimkan barang random.',
            'status' => 1,
        ]);
    }
}
