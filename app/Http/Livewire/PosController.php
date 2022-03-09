<?php

namespace App\Http\Livewire;

use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Denomination;
use App\Models\SaleDetail;
use App\Models\Category;
use Livewire\Component;
use App\Models\Product;
use App\Models\Sale;
use DB;

class PosController extends Component
{

	public $efectivo,$change, $total, $itemsQuantity;
	private $pagination = 6;

	public function render()
	{
		return view('livewire.pos.component',[
			'denomination' => Denomination::orderBy('value','desc')->get(),
			'cart' => Cart::getContent()->sortBy('name')
		])
		->extends('layouts.theme.app')
		->section('content');
	}

	public function ACash($value)
	{
		$this->efectivo += ($value == 0 ? $this->total : $value);
		$this->change = ($this->efectivo - $this->total);
	}

	public function mount()
	{
		$cart = Cart::getContent();
		//$item = array_values($cart);
		//dd($item[0]);
		$this->efectivo = 0;
		$this->change = 0;
		$this->total = Cart::getTotal();
		$this->itemsQuantity = Cart::getTotalQuantity();
	}

	protected $listeners = [
		'scan-code' => 'ScanCode',
		'removeItem' => 'removeItem',
		'clearCart' => 'clearCart',
		'saveSale' => 'saveSale',
		'scan-components',
		'ACash' => 'ACash'
	];


	public function ScanCode($barcode, $cant = 1)
	{
		$product = Product::where('barcode',$barcode)->first();

		if($product == null || empty($product)) {
			$this->emit('scan-notfound','El producto no está registrado');
		} else {

			if($this->InCart($product->id))
			{
				$this->increaseQty($product->id);
				return;
			}

			if($product->stock < 1)
			{
				$this->emit('no-stock', "Stock Insuficiente :/");
				return;
			}

			Cart::add(array(
			'id' => $product->id,
			'name' => $product->name,
			'price' => $product->price,
			'quantity' => $cant,
			'attributes' => array(
			'image' => $product->image,
			'seccionalmacen_id' => $product->seccionalmacen_id,
			'comercio_id' => $product->comercio_id
			)));

			$this->total = Cart::getTotal();
			$this->itemsQuantity = Cart::getTotalQuantity();

			$this->emit('scan-ok','Producto agregado');

		}
	}

	public function InCart($productId)
	{
		$exist = Cart::get($productId);
		if($exist)
			return true;
		else
			return false;
	}

	public function increaseQty($productId, $cant = 1)
	{
		$title;
		$product = Product::find($productId);
		$exist = Cart::get($productId);
		if($exist)
			$title ='Cantidad actualizada';
		else
			$title ='Producto agregado';

		//validamos existencias
		if($exist)
		{
			if($product->stock < ($cant + $exist->quantity ))
			{
				$this->emit('no-stock', "Stock Insuficiente :/");
				return;
			}
		}
		Cart::add(array(
		'id' => $product->id,
		'name' => $product->name,
		'price' => $product->price,
		'quantity' => $cant,
		'attributes' => array(
		'image' => $product->image,
		'seccionalmacen_id' => $product->seccionalmacen_id,
		'comercio_id' => $product->comercio_id
		)));

		$this->total = Cart::getTotal();
		$this->itemsQuantity = Cart::getTotalQuantity();

		$this->emit('scan-ok', $title);
	}



	public function updateQty($productId, $cant = 1)
	{
		$title;
		$product = Product::find($productId);
		$exist = Cart::get($productId);
		if($exist)
			$title ='Cantidad actualizada';
		else
			$title ='Producto agregado';

		//validamos existencias
		if($exist)
		{
			if($product->stock < $cant )
			{
				$this->emit('no-stock', "Stock Insuficiente :/");
				return;
			}
		}

		$this->removeItem($productId);

		if($cant > 0){ //valida si en el input tipo number flecha abajo llega a cero el value
			Cart::add(array(
			'id' => $product->id,
			'name' => $product->name,
			'price' => $product->price,
			'quantity' => $cant,
			'attributes' => array(
			'image' => $product->image,
			'seccionalmacen_id' => $product->seccionalmacen_id,
			'comercio_id' => $product->comercio_id
			)));

			$this->total = Cart::getTotal();
			$this->itemsQuantity = Cart::getTotalQuantity();

			$this->emit('scan-ok', $title);
		}
	}


	public function removeItem($id)
	{
		Cart::remove($id);

		$this->total = Cart::getTotal();
		$this->itemsQuantity = Cart::getTotalQuantity();

		$this->emit('scan-ok', 'Producto eliminado');
	}



	public function decreaseQty($productId)
	{

		$item = Cart::get($productId);
		Cart::remove($productId);

		$newQty = ($item->quantity) - 1;
		//dd($newQty);
		if($newQty > 0)
		Cart::add(array(
		'id' => $product->id,
		'name' => $product->name,
		'price' => $product->price,
		'quantity' => $cant,
		'attributes' => array(
		'image' => $product->image,
		'seccionalmacen_id' => $product->seccionalmacen_id,
		'comercio_id' => $product->comercio_id
		)));

			$this->total = Cart::getTotal();
			$this->itemsQuantity = Cart::getTotalQuantity();
			$this->emit('scan-ok', 'Cantidad actualizada');

	}









	public function AddCash($value)
	{
		if($value > 0)
			$this->efectivo += $value;
		else
			$this->efectivo = $this->total;

	}


	public function updatedEfectivo($value)
	{
		if(is_numeric($value))
			$this->change = $this->efectivo - $this->total;
		else
			$this->change = 0 - $this->total;

	}



	public function clearCart()
	{
		Cart::clear();
		$this->efectivo = 0;
		$this->change = 0;
		$this->total = Cart::getTotal();
		$this->itemsQuantity = Cart::getTotalQuantity();

		$this->emit('scan-ok', 'Carrito Vacío');
	}


	public function saveSale()
	{

		//basic validations
		if($this->total <=0)
		{
			$this->emit('sale-error', 'AGREGA PRODUCTOS A LA VENTA');
			return;
		}
		if($this->efectivo <=0)
		{
			$this->emit('sale-error', 'INGRESA EL EFECTIVO');
			return;
		}
		if($this->total > $this->efectivo)
		{
			$this->emit('sale-error', 'EL EFECTIVO DEBE SER MAYOR O IGUAL AL TOTAL');
			return;
		}



		DB::beginTransaction();

		try {

			//save sale
			$sale = Sale::create([
				'total'   => $this->total,
				'items'   => $this->itemsQuantity,
				'cash'    => $this->efectivo,
				'change'  => $this->change,
				'metodo_pago'  => $this->metodo_pago,
				'user_id' => Auth::user()->id
			]);

			if($sale) {
				$items = Cart::getContent();

				// save sale details
				foreach($items as $item)
				{
					SaleDetail::create([
						'price'      =>$item->price,
						'quantity'   =>$item->quantity,
						'product_id' =>$item->id,
						'seccionalmacen_id' => $item->attributes->seccionalmacen_id,
						'comercio_id' => $item->attributes->comercio_id,
						'sale_id'    =>$sale->id
					]);

					// update stock
					$product = Product::find($item->id);
					$product->stock = $product->stock - $item->quantity;
					$product->save();

				}

			}


			DB::commit();

			Cart::clear();
			$this->efectivo = 0;
			$this->change = 0;
			$this->total = Cart::getTotal();
			$this->itemsQuantity = Cart::getTotalQuantity();
			$this->emit('sale-ok',  'Venta registrada con éxito');
			$this->emit('print-ticket', $sale->id );



		} catch (\Exception $e) {
			DB::rollback();
			$this->emit('sale-error', $e->getMessage());
		}


	}


	public function printTicket($sale)
	{
		return Redirect::to("print://$sale->id");
	}
}
