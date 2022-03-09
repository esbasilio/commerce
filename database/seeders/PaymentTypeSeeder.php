<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentType;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentType::create([
            'name'  => 'Efectivo',
            'slug'  => 'efect'
        ]);

        PaymentType::create([
            'name'  => 'Debito',
            'slug'  => 'debit'
        ]);

        PaymentType::create([
            'name'  => 'Mercado Pago',
            'slug'  => 'mpago'
        ]);

        PaymentType::create([
            'name'  => 'Transferencia',
            'slug'  => 'trans'
        ]);
    }
}
