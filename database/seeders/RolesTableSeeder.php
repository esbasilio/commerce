<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
//importar los modelos
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //creación de usuarios
        User::create([
            'name' => 'Administracion demo',
            'profile' => 'Admin',
            'status' => 'Activo',
            'comercio_id' => '2',
            'email' => 'demo@demo.com',
            'password' => bcrypt('demo2021')
        ]);
        User::create([
            'name' => 'demo Becta comercio',
            'profile' => 'Comercio',
            'status' => 'Activo',
            'comercio_id' => '2',
            'email' => 'comercio@demo.com',
            'password' => bcrypt('demo2021')
        ]);

        User::create([
            'name' => 'demo Franquicia',
            'profile' => 'Franquicia',
            'status' => 'Activo',
            'comercio_id' => '2',
            'email' => 'franquicia@demo.com',
            'password' => bcrypt('demo2021')
        ]);

        // preventistas ---------------------------------
        User::create([
            'name' => 'demo Preventista Juan',
            'profile' => 'Preventista',
            'status' => 'Activo',
            'comercio_id' => '2',
            'email' => 'preventista@demo.com',
            'password' => bcrypt('demo2021')
        ]);
        User::create([
            'name' => 'demo Preventista Raul',
            'profile' => 'Preventista',
            'status' => 'Activo',
            'comercio_id' => '2',
            'email' => 'preventista1@demo.com',
            'password' => bcrypt('demo2021')
        ]);
        User::create([
            'name' => 'demo Preventista Gustavo',
            'profile' => 'Preventista',
            'status' => 'Activo',
            'comercio_id' => '2',
            'email' => 'preventista2@demo.com',
            'password' => bcrypt('demo2021')
        ]);
        User::create([
            'name' => 'demo Preventista Martin',
            'profile' => 'Preventista',
            'status' => 'Activo',
            'comercio_id' => '2',
            'email' => 'preventista3@demo.com',
            'password' => bcrypt('demo2021')
        ]);
        User::create([
            'name' => 'demo Preventista Claudio',
            'profile' => 'Preventista',
            'status' => 'Activo',
            'comercio_id' => '2',
            'email' => 'preventista4@demo.com',
            'password' => bcrypt('demo2021')
        ]);
        // -----------------------------------------------
        User::create([
            'name' => 'demo Cliente Martin',
            'profile' => 'Cliente',
            'status' => 'Activo',
            'comercio_id' => '2',
            'email' => 'cliente@demo.com',
            'password' => bcrypt('demo2021')
        ]);
        User::create([
            'name' => 'demo Cliente Adam',
            'profile' => 'Cliente',
            'status' => 'Activo',
            'comercio_id' => '2',
            'email' => 'cliente1@demo.com',
            'password' => bcrypt('demo2021')
        ]);
        User::create([
            'name' => 'demo Cliente Joe',
            'profile' => 'Cliente',
            'status' => 'Activo',
            'comercio_id' => '2',
            'email' => 'cliente2@demo.com',
            'password' => bcrypt('demo2021')
        ]);
        User::create([
            'name' => 'demo Cliente Steven',
            'profile' => 'Cliente',
            'status' => 'Activo',
            'comercio_id' => '2',
            'email' => 'cliente3@demo.com',
            'password' => bcrypt('demo2021')
        ]);
        User::create([
            'name' => 'demo Cliente Stephen',
            'profile' => 'Cliente',
            'status' => 'Activo',
            'comercio_id' => '2',
            'email' => 'cliente4@demo.com',
            'password' => bcrypt('demo2021')
        ]);
        User::create([
            'name' => 'demo Cliente Bill',
            'profile' => 'Cliente',
            'status' => 'Activo',
            'comercio_id' => '2',
            'email' => 'cliente5@demo.com',
            'password' => bcrypt('demo2021')
        ]);
        User::create([
            'name' => 'demo Cliente Tayler',
            'profile' => 'Cliente',
            'status' => 'Activo',
            'comercio_id' => '2',
            'email' => 'cliente6@demo.com',
            'password' => bcrypt('demo2021')
        ]);
        User::create([
            'name' => 'demo Cliente John',
            'profile' => 'Cliente',
            'status' => 'Activo',
            'comercio_id' => '2',
            'email' => 'cliente7@demo.com',
            'password' => bcrypt('demo2021')
        ]);

        User::create([
            'name' => 'Administracion Indumentaria',
            'profile' => 'Admin',
            'status' => 'Activo',
            'comercio_id' => '1',
            'email' => 'admin@indumentaria.com',
            'password' => bcrypt('demo2021')
        ]);

 		//creación de roles
        $admin       = Role::create(['name' => 'Admin', 'slug' => 'admin']);
        $comercio    = Role::create(['name' => 'Comercio', 'slug' => 'commerce']);
        $franquicia  = Role::create(['name' => 'Franquicia', 'slug' => 'franchise']);
        $preventista = Role::create(['name' => 'Preventista', 'slug' => 'preventative']);
        $cliente     = Role::create(['name' => 'Cliente', 'slug' => 'client']);

        //creación de permisos:
        //categories
        Permission::create(['name' => 'category_index']);
        Permission::create(['name' => 'category_create']);
        Permission::create(['name' => 'category_update']);
        Permission::create(['name' => 'category_destroy']);
        Permission::create(['name' => 'category_edit']);
        Permission::create(['name' => 'category_search']);
        //products
        Permission::create(['name' => 'product_index']);
        Permission::create(['name' => 'product_create']);
        Permission::create(['name' => 'product_update']);
        Permission::create(['name' => 'product_destroy']);
        Permission::create(['name' => 'product_edit']);
        Permission::create(['name' => 'product_search']);
        // product-list-prices
        Permission::create(['name' => 'price_list_create']);
        //orders
        Permission::create(['name' => 'order_index']);
        Permission::create(['name' => 'order_create']);
        Permission::create(['name' => 'order_update']);
        Permission::create(['name' => 'order_destroy']);
        Permission::create(['name' => 'order_edit']);
        Permission::create(['name' => 'order_search']);
        Permission::create(['name' => 'order_select']);
        Permission::create(['name' => 'order_show_detail']);
        Permission::create(['name' => 'order_change_status']);
        //users
        Permission::create(['name' => 'user_index']);
        Permission::create(['name' => 'user_create']);
        Permission::create(['name' => 'user_update']);
        Permission::create(['name' => 'user_destroy']);
        Permission::create(['name' => 'user_edit']);
        Permission::create(['name' => 'user_search']);
        //users type clients
        Permission::create(['name' => 'client_index']);
        Permission::create(['name' => 'client_create']);

        //denominations
        Permission::create(['name' => 'denomination_index']);
        Permission::create(['name' => 'denomination_create']);
        Permission::create(['name' => 'denomination_update']);
        Permission::create(['name' => 'denomination_destroy']);
        Permission::create(['name' => 'denomination_edit']);
        Permission::create(['name' => 'denomination_search']);
        //sales
        Permission::create(['name' => 'sale_index']);
        Permission::create(['name' => 'sale_create']);
        //roles
        Permission::create(['name' => 'role_index']);
        Permission::create(['name' => 'role_create']);
        Permission::create(['name' => 'role_update']);
        Permission::create(['name' => 'role_destroy']);
        Permission::create(['name' => 'role_edit']);
        Permission::create(['name' => 'role_search']);
        //permissions
        Permission::create(['name' => 'permission_index']);
        Permission::create(['name' => 'permission_create']);
        Permission::create(['name' => 'permission_update']);
        Permission::create(['name' => 'permission_destroy']);
        Permission::create(['name' => 'permission_edit']);
        Permission::create(['name' => 'permission_search']);
        //assign
        Permission::create(['name' => 'assign_index']);
        Permission::create(['name' => 'assign_syncall']);
        Permission::create(['name' => 'assign_revokeall']);
        Permission::create(['name' => 'assign_checkbox']);
        // associate an client with and preventist
        Permission::create(['name' => 'associate_index']);
        Permission::create(['name' => 'associate_new']);

        //cash out
        Permission::create(['name' => 'cashout_index']);
        Permission::create(['name' => 'cashout_print']);
        Permission::create(['name' => 'cashout_detail']);
        //reports
        Permission::create(['name' => 'report_index']);
        Permission::create(['name' => 'report_pdf']);
        Permission::create(['name' => 'report_excel']);

        //asignar permisos al role Admin
        $admin->givePermissionTo([
        	'category_index',
        	'category_create',
        	'category_update',
        	'category_destroy',
        	'category_edit',
        	'category_search',
            'product_index',
            'product_create',
            'product_update',
            'product_destroy',
            'product_edit',
            'product_search',
            'price_list_create',
            'order_index',
            'order_create',
            'order_update',
            'order_destroy',
            'order_edit',
            'order_search',
            'order_show_detail',
            'order_change_status',
            'user_index',
            'user_create',
            'user_update',
            'user_destroy',
            'user_edit',
            'user_search',
            'denomination_index',
            'denomination_create',
            'denomination_update',
            'denomination_destroy',
            'denomination_edit',
            'denomination_search',
            'role_index',
            'role_create',
            'role_update',
            'role_destroy',
            'role_edit',
            'role_search',
            'permission_index',
            'permission_create',
            'permission_update',
            'permission_destroy',
            'permission_edit',
            'permission_search',
            'sale_index',
            'sale_create',
            'assign_index',
            'assign_syncall',
            'assign_revokeall',
            'assign_checkbox',
            'associate_index',// associate new
            'associate_new', // preventist -> client
            'cashout_index',
            'cashout_print',
            'cashout_detail',
            'report_index',
            'report_pdf',
            'report_excel'
        ]);
        //asignar permisos al role Comercio
        $comercio->givePermissionTo([
        	'category_index',
        	'category_create',
        	'category_update',
        	'category_destroy',
        	'category_edit',
        	'category_search',
            'product_index',
            'product_create',
            'product_update',
            'product_destroy',
            'product_edit',
            'product_search',
            'price_list_create',
            'order_index',
            'order_create',
            'order_update',
            'order_destroy',
            'order_edit',
            'order_search',
            'order_show_detail',
            'order_change_status',
            'user_index',
            'user_create',
            'user_update',
            'user_destroy',
            'user_edit',
            'user_search',
            'client_index',
            'denomination_index',
            'denomination_create',
            'denomination_update',
            'denomination_destroy',
            'denomination_edit',
            'denomination_search',
            'role_index',
            'role_create',
            'role_update',
            'role_destroy',
            'role_edit',
            'role_search',
            'permission_index',
            'permission_create',
            'permission_update',
            'permission_destroy',
            'permission_edit',
            'permission_search',
            'sale_index',
            'sale_create',
            'assign_index',
            'assign_syncall',
            'assign_revokeall',
            'assign_checkbox',
            'associate_index',
            'associate_new',
            'cashout_index',
            'cashout_print',
            'cashout_detail',
            'report_index',
            'report_pdf',
            'report_excel'
        ]);
        // asignar permisos al role Franquicia
        $franquicia->givePermissionTo([
            'product_index',
            'denomination_index',
            'cashout_index',
            'report_index',
            'client_index'
        ]);

        $preventista->givePermissionTo([
            'product_index',
            'denomination_index',
            'report_index',
            'client_index',
            'client_create',
            'order_select'
        ]);

        $cliente->givePermissionTo([
            'product_index',
            'order_index',
            'order_create',
            'order_update',
            'order_destroy',
            'order_edit',
            'order_search',
            'order_select',
            'order_show_detail'
        ]);

  		//asignar rol al usuario admin
        $uAdmin = User::find(1);
        $uAdmin->assignRole('Admin');

		//asignar rol al usuario comercio
        $uComercio = User::find(2);
        $uComercio->assignRole('Comercio');

		//asignar rol al usuario franquicia
        $uFranquicia = User::find(3);
        $uFranquicia->assignRole('Franquicia');

        // preventist
        $uPreventista = User::find(4);
        $uPreventista->assignRole('Preventista');
        $uPreventista = User::find(5);
        $uPreventista->assignRole('Preventista');
        $uPreventista = User::find(6);
        $uPreventista->assignRole('Preventista');
        $uPreventista = User::find(7);
        $uPreventista->assignRole('Preventista');
        $uPreventista = User::find(8);
        $uPreventista->assignRole('Preventista');

        // clients
        $uCliente = User::find(9);
        $uCliente->assignRole('Cliente');
        $uCliente = User::find(10);
        $uCliente->assignRole('Cliente');
        $uCliente = User::find(11);
        $uCliente->assignRole('Cliente');

        $uCliente = User::find(12);
        $uCliente->assignRole('Cliente');
        $uCliente = User::find(13);
        $uCliente->assignRole('Cliente');
        $uCliente = User::find(14);
        $uCliente->assignRole('Cliente');

        $uCliente = User::find(15);
        $uCliente->assignRole('Cliente');
        $uCliente = User::find(16);
        $uCliente->assignRole('Cliente');
        $uCliente = User::find(17);
        $uCliente->assignRole('Cliente');
        // ________________________________________
        $uAdmin = User::find(6);
        $uAdmin->assignRole('Admin');
    }
}
