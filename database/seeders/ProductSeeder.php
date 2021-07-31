<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'ABACAVIR ABC oral',
            'cost' => 100,
            'price' => 120,
            'barcode' => 75010,
            'stock' => 100,
            'alerts' => 10,
            'category_id' => 1,
            'image' => 'abacavir.png'
        ]);
        Product::create([
            'name' => 'ALBUTEROL',
            'cost' => 80,
            'price' => 120,
            'barcode' => 78958,
            'stock' => 100,
            'alerts' => 10,
            'category_id' => 1,
            'image' => 'albuterol.png'
        ]);
        Product::create([
            'name' => 'AMOXICILINA',
            'cost' => 40,
            'price' => 50,
            'barcode' => 45879,
            'stock' => 145,
            'alerts' => 10,
            'category_id' => 1,
            'image' => 'amoxicilina.png'
        ]);
        Product::create([
            'name' => 'Haloperidol',
            'cost' => 50,
            'price' => 80,
            'barcode' => 457896,
            'stock' => 145,
            'alerts' => 10,
            'category_id' => 2,
            'image' => 'haloperidol.png'
        ]);
        Product::create([
            'name' => 'Heparina sódica',
            'cost' => 50,
            'price' => 80,
            'barcode' => 457896,
            'stock' => 145,
            'alerts' => 10,
            'category_id' => 2,
            'image' => 'heparina.png'
        ]);
        Product::create([
            'name' => 'Hidrocortisona',
            'cost' => 40,
            'price' => 80,
            'barcode' => 4789665,
            'stock' => 145,
            'alerts' => 10,
            'category_id' => 2,
            'image' => 'hidrocortisona.png'
        ]);
        Product::create([
            'name' => 'Ácido azelaico',
            'cost' => 30,
            'price' => 50,
            'barcode' => 8796325,
            'stock' => 145,
            'alerts' => 10,
            'category_id' => 3,
            'image' => 'acido.png'
        ]);
        Product::create([
            'name' => 'Beclometasona',
            'cost' => 50,
            'price' => 60,
            'barcode' => 789542,
            'stock' => 145,
            'alerts' => 10,
            'category_id' => 3,
            'image' => 'beclo.png'
        ]);
        Product::create([
            'name' => 'Bencidamina',
            'cost' => 50,
            'price' => 60,
            'barcode' => 1456987,
            'stock' => 145,
            'alerts' => 10,
            'category_id' => 3,
            'image' => 'benc.png'
        ]);
        Product::create([
            'name' => 'diazepam',
            'cost' => 50,
            'price' => 60,
            'barcode' => 98765432,
            'stock' => 145,
            'alerts' => 10,
            'category_id' => 4,
            'image' => 'benc.png'
        ]);
        Product::create([
            'name' => 'clonazepam',
            'cost' => 50,
            'price' => 60,
            'barcode' => 56789,
            'stock' => 145,
            'alerts' => 10,
            'category_id' => 4,
            'image' => 'clona.png'
        ]);
        Product::create([
            'name' => 'alprazolam',
            'cost' => 50,
            'price' => 60,
            'barcode' => 56789,
            'stock' => 145,
            'alerts' => 10,
            'category_id' => 4,
            'image' => 'alpra.png'
        ]);
        Product::create([
            'name' => 'Albendazol',
            'cost' => 50,
            'price' => 60,
            'barcode' => 6543,
            'stock' => 145,
            'alerts' => 10,
            'category_id' => 5,
            'image' => 'albe.png'
        ]);
        Product::create([
            'name' => 'Mebendazol',
            'cost' => 50,
            'price' => 60,
            'barcode' => 323457563,
            'stock' => 145,
            'alerts' => 10,
            'category_id' => 5,
            'image' => 'mebe.png'
        ]);

        //
    }
}
