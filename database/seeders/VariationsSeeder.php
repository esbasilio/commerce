<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Variation;

class VariationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Variation::create([
            'name' => 'color',
            'options' => json_encode(['rojo', 'amarillo', 'verde', 'azul', 'magenta', 'silver', 'negro', 'dorado'])
        ]);

        Variation::create([
            'name' => 'talle',
            'options' => json_encode(['smal', 'medium', 'large', 'extra'])
        ]);

        Variation::create([
            'name' => 'ram',
            'options' => json_encode(['16gb', '32gb', '64gb', '128gb'])
        ]);

        Variation::create([
            'name' => 'genero',
            'options' => json_encode(['hombre', 'mujer', 'unisex'])
        ]);

    }
}
