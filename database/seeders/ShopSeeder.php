<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shop;
class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shop::create([
            'identification_id' => 1,
            'business_name'     => 'Centro Indumentaria',
            'address_id'        => 1,
            'contact_id'        => 1,
            'logo'              => null,
        ]);

        Shop::create([
            'identification_id' => 2,
            'business_name'     => 'Demo Commerce',
            'address_id'        => 2,
            'contact_id'        => 2,
            'logo'              => null,
        ]);

    }
}
