<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderStatus;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderStatus::create([
            'name'  => 'Entrante',
            'color' => 'lightseagreen',
            'slug'  => 'cread'
        ]);

        OrderStatus::create([
            'name'  => 'Aprobado',
            'color' => 'blue',
            'slug'  => 'aprob'
        ]);

        OrderStatus::create([
            'name'  => 'Rechazado',
            'color' => 'red',
            'slug'  => 'recha'
        ]);

        OrderStatus::create([
            'name'  => 'En proceso',
            'color' => 'purple',
            'slug'  => 'proce'
        ]);

        OrderStatus::create([
            'name'  => 'En camino',
            'color' => 'green',
            'slug'  => 'envia'

        ]);

        OrderStatus::create([
            'name'  => 'Pendiente',
            'color' => 'yellow',
            'slug'  => 'pendi'
        ]);

        OrderStatus::create([
            'name'  => 'Cancelado',
            'color' => 'gray',
            'slug'  => 'cance'
        ]);
    }
}
