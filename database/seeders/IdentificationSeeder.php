<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Identification;

class IdentificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Identification::create([
            'number'    => 76254654,
            'cbu'       => '1234568865488545688455',
            'cuil'      => null,
            'cuit'      => '21-76254654-7'
        ]);

        Identification::create([
            'number'    => 56277654,
            'cbu'       => '489668865488888688433',
            'cuil'      => '-',
            'cuit'      => '56-56277654-4'
        ]);

        // Identification::create([
        //     'number'    => 84548215,
        //     'cbu'       => null,
        //     'cuil'      => null,
        //     'cuit'      => null
        // ]);

        // Identification::create([
        //     'number'    => 27654123,
        //     'cbu'       => 'XXXXXXXXXXXXXXX',
        //     'cuil'      => null,
        //     'cuit'      => '20276541237'
        // ]);

        // Identification::create([
        //     'number'    => 70231047,
        //     'cbu'       => '9994568865483335622450',
        //     'cuil'      => null,
        //     'cuit'      => '10-70231047-4'
        // ]);

        // Identification::create([
        //     'number'    => 90236647,
        //     'cbu'       => '99945680000335669250',
        //     'cuil'      => null,
        //     'cuit'      => '90-90236647-7'
        // ]);
    }
}
