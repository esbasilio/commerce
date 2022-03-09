<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Identification;
use App\Models\Address;
use App\Models\Contact;
use App\Models\Shop;
use App\Models\User;

class CreateShop extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:shop {shop_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $number = date('ymdhs');

        $identification = Identification::create([
            'number'    => $number,
            'cbu'       => date('His') . $number . date('Y'),
            'cuil'      => null,
            'cuit'      => date('i') . '-' . $number . '-' . date('m')
        ]);

        $address = Address::create([
                    'address'           => '',
                    'address_number'    => 0,
                    'reference'         => null
                ]);

        $contact = Contact::create([
            'web_site'  => strtolower(str_replace(' ', '', $this->argument('shop_name'))) . '.com',
            'phone'     => 450003251,
            'fax'       => '03697765',
            'email'     => 'administracion@' . strtolower(str_replace(' ', '', $this->argument('shop_name'))) . '.com'
        ]);

        $shop = Shop::create([
            'identification_id' => $identification->id,
            'business_name'     => $this->argument('shop_name'),
            'address_id'        => $address->id,
            'contact_id'        => $contact->id,
            'logo'              => null,
        ]);

        $Admin = User::create([
            'name' => 'Administracion ' . $this->argument('shop_name'),
            'email' => 'administracion@' . strtolower(str_replace(' ', '', $this->argument('shop_name'))) . '.com',
            'profile' => 'Admin',
            'status' => 'Activo',
            'comercio_id' => $shop->id,
            'password' => bcrypt('demo2021')
        ]);
        $Admin->assignRole('Admin');

        $comercio = User::create([
            'name' => 'Comercio ' . $this->argument('shop_name'),
            'email' => 'comercio@' . strtolower(str_replace(' ', '', $this->argument('shop_name'))) . '.com',
            'profile' => 'Comercio',
            'status' => 'Activo',
            'comercio_id' => $shop->id,
            'password' => bcrypt('demo2021')
        ]);
        $comercio->assignRole('Comercio');

        return 0;
    }
}
