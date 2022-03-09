<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Address;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Address::create([
            'address'           => 'ST Andes',
            'address_number'    => 672,
            'reference'         => null
        ]);

        Address::create([
            'address'           => 'ST San Martin',
            'address_number'    => 762,
            'reference'         => null
        ]);

        // Address::create([
        //     'address'           => 'ST JMU',
        //     'address_number'    => 276,
        //     'reference'         => 'PB C'
        // ]);

        // Address::create([
        //     'address'           => 'ST Zone 1',
        //     'address_number'    => 7010,
        //     'reference'         => null
        // ]);

        // Address::create([
        //     'address'           => 'ST Zone 2',
        //     'address_number'    => 27,
        //     'reference'         => 'PB 1'
        // ]);
    }
}
