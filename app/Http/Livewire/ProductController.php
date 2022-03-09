<?php

namespace App\Http\Livewire;

use App\Models\ProductVariationAttribute;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductSelectedItem;
use App\Models\ProductHasVariation;
use App\Models\seccionalmacen;
use App\Models\EntityRelation;
use App\Models\ProductChannel;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use App\Models\PaymentType;
use App\Models\Variation;
use App\Models\Category;
use Livewire\Component;
use App\Models\Product;
use App\Models\Order;
use Hamcrest\Type\IsBoolean;

class ProductController extends Component
{
	use WithPagination;
	use WithFileUploads;

	public $name, $barcode, $cost, $price, $stock, $alerts, $categoryid, $search, $image, $selected_id, 
	$pageTitle, $componentName, $comercio_id, $almacen, $sale_channels = [], $channel, $preventative, 
	$franchise, $client, $commerce, $selected_products = [], $variation_list = [];

	private $pagination = 7;

	public function paginationView()
	{
		return 'vendor.livewire.bootstrap';
	}

	public function mount()
	{
		$this->pageTitle = 'Listado';
		$this->componentName = 'Productos';
		$this->categoryid = 'Elegir';
		$variations = Variation::orderBy('name')->get()->toArray();
		$this->variation_list = [];
		foreach($variations as $v){
			$this->variation_list[$v['name']] = [
				'id'      => $v['id'], 
				'name'    => $v['name'],
				'options' => json_decode($v['options'])
			];
		}
	}


	public function addAttrName($variation_id, $attribute_id)
	{
		if($attribute_id != '0'){

			$pva = ProductVariationAttribute::where([
				'variation_id' => $variation_id,
				'attribute_id' => $attribute_id
			])->first();

			if(!empty($pva) == 0){
				ProductVariationAttribute::create([
					'variation_id' => $variation_id,
					'attribute_id' => $attribute_id,
					'attribute_value' => ''
				]);
			}
		}
		$this->Edit($this->selected_id);
	}


	public function setAttrValue($variation_id, $attribute_value)
	{
		if($attribute_value != '0' && $attribute_value != ''){
			$pva = ProductVariationAttribute::find($variation_id);
			if(!empty($pva)){
				$pva->attribute_value = $attribute_value;
				$pva->save();
			}
		}
		$this->Edit($this->selected_id);
	}

	public function createVariation($variation_name)
	{
		$variation_name = trim($variation_name);

		if(!empty($variation_name)){

			ProductHasVariation::firstOrCreate([
				'product_id'     => $this->selected_id,
				'variation_name' => $variation_name
			]);
			$this->Edit($this->selected_id);

		}
	}

	public function updateVariation($variation_id, $variation_name)
	{
		$variation_name = trim($variation_name);

		if(!empty($variation_name)){

			$variation = ProductHasVariation::find($variation_id);

			if(!empty($variation)){
				$variation->variation_name = $variation_name;
				$variation->save();
			}
		}
	}

	private function setSelectedProducts()
	{
		$this->selected_products = [];
		$psi = ProductSelectedItem::where([
			'shop_id'	 => Auth::user()->getEnityRelationship('id'),
			'person_id'  => Auth::user()->id
		])->get();
		if(!empty($psi)){
			foreach($psi as $ps){
				$this->selected_products[$ps->product_id] = [
					'reg_id'     => $ps->id, 
					'prod_price' => $ps->product_price,
					'quantity'   => $ps->quantity
				];
			}
		}
	}

	public function render()
	{
		//dd(auth()->user()->hasRole([3,6,9]));
		//if(Auth::user()->comercio_id != 1)
		$comercio_id = Auth::user()->comercio_id;

		$channel_id = null;

		if(Auth::user()->profile != 'Admin'){
			$channel = EntityRelation::where(['sale_channel' => Auth::user()->profile])->first();
			if(!empty($channel) && $channel->role_slug != "commerce"){
				$channel_id = $channel->id;
			}

			$this->setSelectedProducts();
		}

		if(strlen($this->search) > 0)
			$products = Product::join('categories as c','c.id','products.category_id')
			->join('seccionalmacens as a','a.id','products.seccionalmacen_id')
			->select('products.*','c.name as category','a.nombre as almacen')
			->where('products.name', 'like', '%' . $this->search . '%')
			->where('products.comercio_id', '=', $comercio_id)
			//->orWhere('products.barcode', 'like', '%' . $this->search . '%')
			//->orWhere('c.name', 'like', '%' . $this->search . '%')
			//->orWhere('products.comercio_id', '=', $comercio_id)
			->orderBy('products.name','asc')
			->paginate($this->pagination);
		else
			if($channel_id!=null){
				$products = Product::join('categories as c','c.id','products.category_id')
				->join('seccionalmacens as a','a.id','products.seccionalmacen_id')
				->join('product_channels as pp', 'pp.product_id', 'products.id')
				->select('products.id', 'products.name', 'products.comercio_id', 'products.barcode', 
				'products.cost' /*, 'pp.price'*/, 'products.stock', 'products.alerts', 
				'products.image', 'products.seccionalmacen_id', 'products.category_id', 
				'products.created_at', 'products.updated_at','c.name as category','a.nombre as almacen')
				->where('products.comercio_id', '=', $comercio_id)
				->where('pp.channel_id', '=', $channel_id)
				->orderBy('products.name','asc')
				->paginate($this->pagination); //dd($products);
			}else{
				$products = Product::join('categories as c','c.id','products.category_id')
				->join('seccionalmacens as a','a.id','products.seccionalmacen_id')
				//->join('product_prices as pp', 'pp.product_id', 'products.id')
				->select('products.*','c.name as category','a.nombre as almacen')
				->where('products.comercio_id', '=', $comercio_id)
				//->where('pp.channel_id', '=', $channel->id)
				->orderBy('products.name','asc')
				->paginate($this->pagination);
			}

		return view('livewire.products.component',[
			'data' => $products,
			'categories' => Category::orderBy('name','asc')->where('comercio_id', 'like', $comercio_id)->get(),
			'almacenes' => seccionalmacen::orderBy('nombre','asc')->where('comercio_id', 'like', $comercio_id)->get()
		])
		->extends('layouts.theme.app')
		->section('content');
	}

	public function Store()
	{
		//validation rules
		$rules = [
			'name' => 'required|unique:products|min:3',
			'cost' => 'required',
			'price' => 'required',
			'stock' => 'required',
			'almacen' => 'required',
			'alerts' => 'required',
			'categoryid' => 'required|not_in:Elegir'
		];


		//custom messages
		$customMessages = [
			'name.required' => 'Nombre del producto requerido',
			'name.unique' => 'Ya existe el producto',
			'name.min' => 'El nombre debe tener al menos 3 caracteres',
			'cost.required' => 'El costo es requerido',
			'price.required' => 'Precio de venta requerido',
			'stock.required' => 'Ingresa las existencias',
			'almacen.required' => 'Ingresa el almacen',
			'alerts.required' => 'Falta el valor para las alertas',
			'categoryid.not_in' => 'Elige una categoría válida'
		];

		//execute validate
		$this->validate($rules, $customMessages);


		//insert
		$product =  Product::create([
			'name' => $this->name,
			'cost' => str_replace(',', '', $this->cost),
			'price' => str_replace(',', '', $this->price),
			'barcode' => $this->barcode,
			'stock' => $this->stock,
			'alerts' => $this->alerts,
			'seccionalmacen_id' => $this->almacen,
			'category_id' => $this->categoryid,
			'comercio_id' => Auth::user()->comercio_id
		]);


		//save image
		if($this->image)
		{
			$customFileName	 = uniqid() . '_.' . $this->image->extension();
			$this->image->storeAs('public/products', $customFileName);
			$product->image = $customFileName;
			$product->save();
		}

		
		foreach(EntityRelation::all() as $channel){

			$channel_name = $channel->role_slug;

			$price = ProductChannel::where([
				'channel_id' => $channel->id,
				'product_id' => $product->id
			])->first();

			if(empty($price)){
				$price = ProductChannel::create([
					'channel_id' => $channel->id,
					'product_id' => $product->id
				]);
			}

			$price->save();
		}

		// clear inputs
		$this->resetUI();
		// emit frontend notification
		$this->emit('product-added', 'Producto Registrado');
	}


	public $product_variations = [];

	public function Edit($id)
	{
		$this->product_variations = [];
		$record = Product::find($id);
		$this->selected_id = $record->id;
		$this->name = $record->name;
		$this->barcode = $record->barcode;
		$this->cost = $record->cost;
		$this->price = $record->price;
		$this->stock = $record->stock;
		$this->alerts = $record->alerts;
		$this->categoryid = $record->category_id;
		$this->almacen = $record->seccionalmacen_id;
		$this->image = null;
		$this->sale_channels = [];

		foreach(EntityRelation::all() as $sale_channel){

			$this->sale_channels[] = [
				'label_channel' => $sale_channel->sale_channel,
				'slug' => $sale_channel->role_slug,
			];

			$_channel = ProductChannel::where([
				'channel_id' => $sale_channel->id,
				'product_id' => $id
			])->first();

			$channel = $sale_channel->role_slug;
			$this->$channel = !empty($_channel) ? 1 : 0;
		}

		$product_variations = ProductHasVariation::select('id', 'variation_name')
									->where(['product_id'=>$id])->get();

		if(count($product_variations) == 0){

			// foreach($product_variations as $pv){
			// 	$options = [];
			// 	foreach($pv->productVariationAttrs()->get() as $attr){
			// 		$options[] = [
			// 			'attribute_id' => $attr->attribute_id,
			// 			'value' 	   => $attr->attribute_value,
			// 			'key'   	   => $attr->attribute()->first()->name,
			// 			'id'    	   => $attr->id
			// 		];
			// 	}

			// 	$this->product_variations[] = [
			// 		'variation_name' => $pv['variation_name'],
			// 		'options'        => $options,
			// 		'id'             => $pv['id']
			// 	];
			// 	unset($options);
			// }
		//}else{
			ProductHasVariation::create([
				'variation_name' => 'variacion_1',
				'product_id'     => $id
			]);
			$product_variations = ProductHasVariation::select('id', 'variation_name') // no lo toma recien creado
									->where(['product_id'=>$id])->get();
		}

		foreach($product_variations as $pv){

			if(!empty($pv->productVariationAttrs()->get())){
				$options = [];
				foreach($pv->productVariationAttrs()->get() as $attr){
					$options[] = [
						'attribute_id' => $attr->attribute_id,
						'value' 	   => $attr->attribute_value,
						'key'   	   => $attr->attribute()->first()->name,
						'id'    	   => $attr->id
					];
				}

				$this->product_variations[] = [
					'variation_name' => $pv['variation_name'],
					'options'        => $options,
					'id'             => $pv['id']
				];
				unset($options);
			}else{
				$this->product_variations[] = [
					'variation_name' => $pv->variation_name,
					'options'        => null,
					'id'             => $pv->id
				];
			}
		}

		$this->emit('show-modal','Show modal!');
	}


	public function Update()
	{
 		//validation rules
		$rules = [
			'name' => "required|min:3|unique:products,name,{$this->selected_id}",
			'cost' => 'required',
			'price' => 'required',
			'stock' => 'required',
			'alerts' => 'required',
			'almacen' => 'required',
			'categoryid' => 'required|not_in:Elegir'
		];


		//custom messages
		$customMessages = [
			'name.required' => 'Nombre de producto requerido',
			'name.unique' => 'Ya existe el producto',
			'name.min' => 'El nombre debe tener al menos 3 caracteres',
			'cost.required' => 'El costo es requerido',
			'price.required' => 'Precio de venta requerido',
			'stock.required' => 'Ingresa las existencias',
			'almacen.required' => 'Ingresa la seccion del almacen',
			'alerts.required' => 'Ingresa el valor mínimo en existencias',
			'categoryid.not_in' => 'Elige un nombre de categoría diferente de Elegir',
		];

		//execute validate
		$this->validate($rules, $customMessages);

		//update
		$product = Product::find($this->selected_id);
		$product->update([
			'name' => $this->name,
			'cost' => $this->cost,
			'price' => $this->price,
			'barcode' => $this->barcode,
			'stock' => $this->stock,
			'alerts' => $this->alerts,
			'seccionalmacen_id' => $this->almacen,
			'category_id' => $this->categoryid
		]);

		//save image
		if($this->image)
		{
			$customFileName	 = uniqid() . '_.' . $this->image->extension();
			$this->image->storeAs('public/products', $customFileName);
			$imageTemp = $product->image;

			$product->image = $customFileName;
			$product->save();

			if($imageTemp !=null)  {
				if (file_exists('storage/products/'. $imageTemp)) {
					unlink('storage/products/'. $imageTemp);
				}
			}
		}

		foreach(EntityRelation::all() as $channel){

			$channel_name = $channel->role_slug;

			if($this->$channel_name > 0){
				ProductChannel::firstOrCreate([
					'channel_id' => $channel->id,
					'product_id' => $product->id
				]);
			}else{
				$prod_channel = ProductChannel::where([
					'channel_id' => $channel->id,
					'product_id' => $product->id
				])->first();
				if(!empty($prod_channel)){
					$prod_channel->delete();
				}
			}
		}

		$this->resetUI();
		$this->emit('product-updated', 'Producto Actualizado');
	}

	// reset values inputs
	public function resetUI()
	{
		$this->name ='';
		$this->barcode ='';
		$this->cost ='';
		$this->price ='';
		$this->stock ='';
		$this->alerts ='';
		$this->search ='';
		$this->almacen ='';
		$this->categoryid = 'Elegir';
		$this->image = null;
		$this->selected_id = 0;
		$this->sale_channels = [];
		$this->selected_products = [];

	}

	//events listeners
	protected $listeners = [
		'deleteRow'   => 'Destroy'
	];

	public function Destroy(Product $product)
	{
		$imageTemp = $product->image;
		$product->delete();

		if($imageTemp !=null) unlink('storage/products/'. $imageTemp);

		$this->resetUI();
		$this->emit('product-deleted', 'Producto Eliminado');
	}

	public $product_selected_item_id;

	public function selectProduct($product, $active)
	{
		$this->product_selected_item_id = 0;
		$user = Auth::user();

		$psi = ProductSelectedItem::where([
			'shop_id'	 	=> $user->getEnityRelationship('id'),
			'product_id' 	=> $product['id'],
			'person_id'  	=> $user->id
		])->first();

		if($active){
			if(empty($psi)){
				$psid = ProductSelectedItem::create([
					'shop_id'	    => $user->getEnityRelationship('id'), 
					'product_id'    => $product['id'],
					'person_id'     => $user->id,
					//'product_price' => $product['price'],
					'quantity'		=> 1
				]);

				$this->product_selected_item_id = $psid->id;
			}
		}else{
			if(!empty($psi)){
				ProductSelectedItem::destroy($psi->id);
			}
		}
		$this->setSelectedProducts();
		if($active)
		$this->emit('show-quantity-form', 'Cantidad');
	}

	public function unselectProducts()
	{
		foreach($this->selected_products as $p){
			ProductSelectedItem::destroy($p['reg_id']);
		}
		$this->selected_products = [];
	}

	public function finishOrder()
	{

		if(!empty($this->selected_products)){

			$order_status = OrderStatus::whereSlug('cread')->first();
			$payment_type = PaymentType::whereSlug('efect')->first();
			$order = Order::create([
				'status_id' 	  => $order_status->id,
				'person_id' 	  => Auth::user()->id,
				'shop_id'   	  => Auth::user()->getEnityRelationship('id'),
				'payment_type_id' => $payment_type->id,
				'total'			  => 0
			]);
			$total = 0;
			foreach($this->selected_products as $prod_id => $prod){

				OrderDetail::create([
					'order_id'      => $order->id, 
					'product_id'    => $prod_id,
					'product_price' => ($prod['prod_price'] * $prod['quantity']),
					'quantity'      => $prod['quantity']
				]);
				$total+= ($prod['prod_price'] * $prod['quantity']);
			}
			$order->total = $total;
			$order->save();
			$this->unselectProducts();
			$this->emit('order-added', 'Se creo el pedido !');
		}
	}

	public $current_quantity;

	public function updateQuantity()
	{
		$psi = ProductSelectedItem::find($this->product_selected_item_id);
		$psi->quantity = ($this->current_quantity > 0) ? $this->current_quantity : 1;
		$this->current_quantity = 1;
		$psi->save();
	}
}
