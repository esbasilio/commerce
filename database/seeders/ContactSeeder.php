<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contact::create([
            'web_site'  => 'www.demo.com',
            'phone'     => 458963251,
            'fax'       => '0365-2465',
            'email'     => 'commerceone@demo.com'
        ]);

        Contact::create([
            'web_site'  => 'www.demo2.com',
            'phone'     => 4895542151,
            'fax'       => '0358 4521',
            'email'     => 'commerceone@demo2.com'
        ]);

        // Contact::create([
        //     'web_site'  => null,
        //     'phone'     => 155632417,
        //     'fax'       => null,
        //     'email'     => 'dap33@gmail.com'
        // ]);

        // Contact::create([
        //     'web_site'  => null,
        //     'phone'     => 155333999,
        //     'fax'       => null,
        //     'email'     => 'esb360@gmail.com'
        // ]);

        // Contact::create([
        //     'web_site'  => 'franquicia1.com.ar',
        //     'phone'     => 4525741,
        //     'fax'       => 45145241,
        //     'email'     => 'franquicia1@gmail.com'
        // ]);

        // Contact::create([
        //     'web_site'  => 'fhost.com.ar',
        //     'phone'     => 45562145,
        //     'fax'       => null,
        //     'email'     => 'fhost@gmail.com'
        // ]);
    }
}
