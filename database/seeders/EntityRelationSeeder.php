<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EntityRelation;

class EntityRelationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EntityRelation::create([
            'role_slug' => 'commerce',
            'entity'    => 'App\Models\Franchise',
            'sale_channel'    => 'Comercio'
        ]);

        EntityRelation::create([
            'role_slug' => 'franchise',
            'entity'    => 'App\Models\Franchise',
            'sale_channel'    => 'Franquicia'
        ]);

        EntityRelation::create([
            'role_slug' => 'preventative',
            'entity'    => 'App\Models\Preventist',
            'sale_channel'    => 'Preventista'
        ]);

        EntityRelation::create([
            'role_slug' => 'client',
            'entity'    => 'App\Models\Client',
            'sale_channel'    => 'Cliente'
        ]);

    }
}
