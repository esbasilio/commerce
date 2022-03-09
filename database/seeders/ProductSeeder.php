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
			'name'        		=> 'LARAVEL Y LIVEWIRE',
      		'comercio_id' 		=> 2,
			'cost'        		=> 200,
			'price'       		=> 350,
			'barcode'     		=> '7503004722068',
			'stock' 	  		=> 1000,
			'alerts'      		=> 10,
			'category_id' 		=> 1,
			'image'		  		=> 'curso.png',
			'seccionalmacen_id' => 1
		]);
		
		Product::create([
			'name'        		=> 'RUNNING NIKE',
      		'comercio_id' 		=> 1,
			'cost'        		=> 600,
			'price'       		=> 1500,
			'barcode'     		=> '9789707804883',
			'stock' 	  		=> 1000,
			'alerts'      		=> 10,
			'category_id' 		=> 2,
			'image'		  		=> '600a0432bc3c6_.jpg',
			'seccionalmacen_id' => 1
		]);

		Product::create([
			'name'        		=> 'ROLEX OYSTER',
		    'comercio_id' 		=> 2,
			'cost'        		=> 500,
			'price'       		=> 1200,
			'barcode'     		=> '7501005180658',
			'stock' 	  		=> 1000,
			'alerts'      		=> 10,
			'category_id' 		=> 3,
			'image'		  		=> 'rolex.jpg',
			'seccionalmacen_id' => 1
		]);
		Product::create([
			'name'        		=> 'IPHONE 11',
      		'comercio_id' 		=> 2,
			'cost'        		=> 900,
			'price'       		=> 1400,
			'barcode'     		=> '078742727073',
			'stock' 	  		=> 1000,
			'alerts'      		=> 10,
			'category_id' 		=> 4,
			'image'		  		=> 'iphone11.jpg',
			'seccionalmacen_id' => 1
		]);
		Product::create([
			'name'        		=> 'PREDATOR PC',
      		'comercio_id' 		=> 2,
			'cost'        		=> 850,
			'price'       		=> 1630,
			'barcode'     		=> '605388343277',
			'stock' 	  		=> 1000,
			'alerts'      		=> 10,
			'category_id' 		=> 5,
			'image'		  		=> 'pcgamer.jpg',
			'seccionalmacen_id' => 1
		]);
		Product::create([
			'name'        		=> 'HARLEY D20',
		    'comercio_id' 		=> 2,
			'cost'        		=> 3500,
			'price'       		=> 5000,
			'barcode'     		=> '7501001600426',
			'stock' 	  		=> 1000,
			'alerts'      		=> 10,
			'category_id' 		=> 6,
			'image'		  		=> 'harley.jpg',
			'seccionalmacen_id' => 1
		]);

		Product::create([
			'name'        		=> 'Campera deportiva',
		    'comercio_id' 		=> 1,
			'cost'        		=> 3500,
			'price'       		=> 5000,
			'barcode'     		=> '1231001600426',
			'stock' 	  		=> 10,
			'alerts'      		=> 10,
			'category_id' 		=> 2,
			'image'		  		=> 'harley.jpg',
			'seccionalmacen_id' => 1
		]);

		Product::create([
			'name'        		=> 'Raqueta de tenis',
		    'comercio_id' 		=> 1,
			'cost'        		=> 9500,
			'price'       		=> 15000,
			'barcode'     		=> '6631991600426',
			'stock' 	  		=> 10,
			'alerts'      		=> 10,
			'category_id' 		=> 2,
			'image'		  		=> 'harley.jpg',
			'seccionalmacen_id' => 1
		]);

		Product::create([
			'name'        		=> 'Pelota de tenis',
		    'comercio_id' 		=> 1,
			'cost'        		=> 9500,
			'price'       		=> 15000,
			'barcode'     		=> '9933691633426',
			'stock' 	  		=> 10,
			'alerts'      		=> 10,
			'category_id' 		=> 2,
			'image'		  		=> 'harley.jpg',
			'seccionalmacen_id' => 1
		]);

    }
}
