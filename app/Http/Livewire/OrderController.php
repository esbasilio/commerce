<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\OrderStatus;
use Livewire\Component;
use App\Models\Product;
use App\Models\Order;
class OrderController extends Component
{
	use WithPagination;
	use WithFileUploads;

	public $search, $selected_id = -1, $pageTitle, $componentName, $comercio_id;
	public $componentDescription, $order, $order_details, $total = 0;
	private $pagination = 25;

	public function paginationView()
	{
		return 'vendor.livewire.bootstrap';
	}

	public function mount()
	{
		$this->pageTitle = 'Listado';
		$this->componentName = 'Ordenes';
		$this->componentDescription = 'Detalle';
	}

	public function resetUI()
	{
		$this->order = null;
		$this->order_details = null;
		$this->total = 0;
	}

	public function render()
	{

		$comercio_id = Auth::user()->comercio_id;

		if(Auth::user()->profile != 'Admin' && Auth::user()->profile != 'Comercio'){
			$filters = ['person_id' => Auth::user()->id, 'shop_id' => $comercio_id];
		}else{

			$filters = ['shop_id' =>$comercio_id];
		}

		$orders = Order::where($filters)
			->orderBy('orders.created_at')
			->paginate($this->pagination);

		return view('livewire.orders.component',[
			'data' => $orders,
			'statuses' => OrderStatus::orderBy('name', 'ASC')->get()
		])
		->extends('layouts.theme.app')
		->section('content');
	}

	public function showOrderDetails($order_id)
	{
		$this->resetUI();
		$this->order = Order::find($order_id);
		$this->order_details = $this->order->details()->get();
		$this->total = $this->order->total;

		$this->emit('show-modal','Show modal!');
	}

	public function setOrderStatus($order_id, $status_id)
	{
		$order_status = OrderStatus::find($status_id);
		$order = Order::find($order_id);

		if($order->status()->first()->slug != 'cance' ){

			if($order_status->slug === 'envia'){

				foreach($order->details()->get() as $od){
					$product = Product::find($od->product_id);
					$product->stock = $product->stock - $od->quantity;
					$product->save();
				}
			}elseif($order_status->slug === 'cance'){
	
				foreach($order->details()->get() as $od){
					$product = Product::find($od->product_id);
					$product->stock = $product->stock + $od->quantity;
					$product->save();
					$od->quantity = 0;
					$od->save();
				}
			}
			$order->status_id = $status_id;
			$order->save();
		}
	}
}
