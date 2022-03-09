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
        	'name'  => 'CURSOS',
          'comercio_id' => 2,
        	'image' => '600d94a35c2e3_.png'
        ]);
        Category::create([
        	'name' => 'TENIS',
          'comercio_id' => 1,
        	'image' => '600a0432bc3c6_.jpg'
        ]);
        Category::create([
        	'name' => 'RELOJES',
          'comercio_id' => 2,
        	'image' => '600a062d6034a_.jpg'
        ]);
        Category::create([
        	'name' => 'CELULARES',
          'comercio_id' => 2,
        	'image' => '600a0524c6317_.jpg'
        ]);
        Category::create([
        	'name' => 'COMPUTADORAS',
          'comercio_id' => 2,
        	'image' => '600ca90d23f6b_.jpg'
        ]);
        Category::create([
        	'name' => 'MOTOCICLETAS',
          'comercio_id' => 2,
        	'image' => '600cb13a4c603_.jpg'
        ]);

        Category::insert([
            [   'name' => 'CURSOS',
                'comercio_id' => 2,
                'image'=> 'https://www.colorbook.io/imagecreator.php?hex=74ECF9}&width=100&height=100&text=Hello'
            ],
            [
                'name' => '',
                'comercio_id' => '',
                'image' => ''
            ],
        ]);
    }
}
