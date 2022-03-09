<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\seccionalmacen;

class SeccionAlmacenesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        seccionalmacen::create([
            'nombre'        => 'seccion 1',
                'comercio_id' => 1
        ]);

        seccionalmacen::create([
            'nombre'        => 'seccion 2',
                'comercio_id' => 1
        ]);


        seccionalmacen::create([
            'nombre'        => 'seccion 1',
                'comercio_id' => 2
        ]);
        seccionalmacen::create([
            'nombre'        => 'seccion 2',
                'comercio_id' => 2
        ]);


        seccionalmacen::create([
            'nombre'        => 'seccion 1',
                'comercio_id' => 3
        ]);
        seccionalmacen::create([
            'nombre'        => 'seccion 2',
                'comercio_id' => 3
        ]);


        seccionalmacen::create([
            'nombre'        => 'seccion 1',
                'comercio_id' => 4
        ]);
        seccionalmacen::create([
            'nombre'        => 'seccion 2',
                'comercio_id' => 4
        ]);
    }
}
