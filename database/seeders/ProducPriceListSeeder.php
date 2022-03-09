<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductPriceList;


class ProducPriceListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductPriceList::create(['name' => 'cliente 1']);
        ProductPriceList::create(['name' => 'cliente 2']);
        ProductPriceList::create(['name' => 'cliente 3']);
        ProductPriceList::create(['name' => 'comercio 0']);
        ProductPriceList::create(['name' => 'comercio 1']);
        ProductPriceList::create(['name' => 'preventista 1']);
        ProductPriceList::create(['name' => 'preventista 2']);
        ProductPriceList::create(['name' => 'franquicia 0']);
        ProductPriceList::create(['name' => 'franquicia 1']);
        ProductPriceList::create(['name' => 'franquicia 2']);
    }
}
