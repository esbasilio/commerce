<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      // \App\Models\User::factory(10)->create();
      $this->call(AddressSeeder::class);
      $this->call(ContactSeeder::class);
      $this->call(IdentificationSeeder::class);
      $this->call(ShopSeeder::class);
      $this->call(RolesTableSeeder::class);
      $this->call(DenominationSeeder::class);
      $this->call(CategorySeeder::class);
      $this->call(SeccionAlmacenesSeeder::class);
      $this->call(ProductSeeder::class);
      $this->call(ClientSeeder::class);
      $this->call(PreventistSeeder::class);
      $this->call(FranchiseSeeder::class);
      $this->call(EntityRelationSeeder::class);
      $this->call(PaymentTypeSeeder::class);
      $this->call(OrderStatusSeeder::class);
      $this->call(VariationsSeeder::class);
      $this->call(ProducPriceListSeeder::class);

    }
  }
