<?php

use App\Http\Controllers\ExportReportsController;
use App\Http\Livewire\ProductPriceController;
use App\Http\Livewire\PaymentTypeController;
use App\Http\Livewire\ProductAddController;
use App\Http\Livewire\VariationController;
use App\Http\Livewire\AssociateController;
use App\Http\Livewire\CategoryController;
use App\Http\Livewire\PermisosController;
use App\Http\Livewire\CategoriasFabricas;
use App\Http\Livewire\ProductController;
use App\Http\Livewire\CashoutController;
use App\Http\Livewire\ReportsController;
use App\Http\Livewire\AsignarController;
use App\Http\Livewire\ProductosFabricas;
use App\Http\Livewire\ClientController;
use App\Http\Livewire\VentasController;
use App\Http\Livewire\RolesController;
use App\Http\Livewire\Seccionalmacens;
use App\Http\Livewire\OrderController;
use App\Http\Livewire\CoinsController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ReportsDetalle;
use App\Http\Livewire\UserController;
use App\Http\Livewire\PosController;

Route::get('/', function () {
	return view('auth.login');
});

//Auth::routes();

Auth::routes(['register' => false]); // deshabilitamos el registro de nuevos users

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group( function() {

	Route::get('categories', CategoryController::class);
	Route::get('products', ProductController::class);
	Route::get('products/add', ProductAddController::class);
	Route::get('products/edit/{id}', ProductAddController::class);
	Route::get('variations', VariationController::class);
	Route::get('price-list', ProductPriceController::class);
	Route::get('payment-type', PaymentTypeController::class);
	Route::get('orders', OrderController::class);
	Route::get('pos', PosController::class);
	Route::get('coins', CoinsController::class);
	Route::get('cashout', CashoutController::class);
	Route::get('reports', ReportsController::class);
	Route::get('users', UserController::class);
	Route::get('clients', ClientController::class);
	Route::get('profile', [UserController::class, 'profile']);
	Route::get('productos-fabricas', ProductosFabricas::class);

	//reportes pdf
	Route::get('report/pdf/{user}/{type}/{f1}/{f2}', [ExportReportsController::class, 'reportPDF']);
	Route::get('order/pdf/export/{id}', [ExportReportsController::class, 'getOrderPDF']);
	Route::get('report/pdf/{user}/{type}', [ExportReportsController::class, 'reportPDF']);

	//reportes excel
	Route::get('report/excel/{user}/{type}/{f1}/{f2}', [ExportReportsController::class, 'reporteExcel']);
	Route::get('report/excel/{user}/{type}', [ExportReportsController::class, 'reporteExcel']);

	//reportes excel
	Route::get('report-detalle/excel/{user}/{type}/{f1}/{f2}', [ExportReportsController::class, 'reporteExcelDetalle']);
	Route::get('report-detalle/excel/{user}/{type}', [ExportReportsController::class, 'reporteExcelDetalle']);


	// SON MECANISMOS QUE NOS AYUDAN A FILTRAR PETICIONES HTTP EN NUESTRO SISTEMA
	// PODEMOS VERLOS COMO UNA CAPA INTERMEDIA ENTRE LA SOLICITUD HTTP Y EL RECURSO (VISTA, IMAGEN, ARCHIVO PDF, ETC)

	//roles y permisos
	Route::get('roles', RolesController::class);

	//Reporte detalle de productos vendidos
	Route::get('reportes-detalle', ReportsDetalle::class);

	Route::get('/remove-product-from-cart/{product}', [VentasController::class,'removeProductFromCart'])->name('remove_product_from_cart');
	Route::get('/cart', [VentasController::class,'showCart'])->name('cart');

	//Route::get('/home', 'HomeController@index')->name('home');
});




Route::middleware(['auth'])->group( function() {

//rutas aqui

});
