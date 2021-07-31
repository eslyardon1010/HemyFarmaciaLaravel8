<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Orales',
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);
        Category::create([
            'name' => ' intravenosos',
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);
        Category::create([
            'name' => 'Productos dermatológicos',
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);
        Category::create([
            'name' => 'Sistema nervioso central',
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);
        Category::create([
            'name' => 'Productos antiparasitarios',
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);

        //
    }
}
