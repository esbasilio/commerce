<?php

namespace App\Http\Livewire;
use App\Models\ProductVariationAttribute;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductHasVariation;
use App\Models\ProductPriceList;
use App\Models\seccionalmacen;
use App\Models\EntityRelation;
use App\Models\ProductChannel;
use Illuminate\Http\Request;
use App\Models\ProductPrice;
use App\Models\Variation;
use App\Models\Category;
use Livewire\Component;
use App\Models\Product;

class ProductAddController extends Component
{

	public $componentName, $categoryid, $almacen, $alerts, $stock, $price, $cost, $barcode, $name, $variation_list = [], 
			$image, $sale_channels = [], $channel, $preventative, $franchise, $client, $commerce, $selected_id,
			$current_price, $current_list, $variation_id, $product_prices = [], $entity_type;

	public function resetUI()
	{

		$this->name ='';
		$this->barcode ='';
		$this->cost ='';
		$this->price ='';
		$this->stock ='';
		$this->alerts ='';
		$this->almacen ='';
		$this->categoryid = 'Elegir';
		$this->image = null;
		$this->selected_id = 0;
		$this->sale_channels = [];
		$this->current_price = 0;
		//$this->selected_products = [];
	}

	public function mount()
	{
		$this->pageTitle = 'Listado';
		$this->componentName = 'Productos';
		$this->categoryid = 'Elegir';
		$variations = Variation::orderBy('name')->get()->toArray();
		$this->variation_list = [];
		$this->resetPriceValues();

		foreach($variations as $v){
			$this->variation_list[$v['name']] = [
				'id'      => $v['id'], 
				'name'    => $v['name'],
				'options' => json_decode($v['options'])
			];
		}
	}

	public function render(Request $request)
	{

		if($request->id!=null){
			$this->Edit($request->id);
		}

		$comercio_id = Auth::user()->comercio_id;
		return view('livewire.products.form-prod',[
			'categories' => Category::orderBy('name','asc')->where('comercio_id', 'like', $comercio_id)->get(),
			'almacenes' => seccionalmacen::orderBy('nombre','asc')->where('comercio_id', 'like', $comercio_id)->get(),
			'price_lists' => ProductPriceList::all()
		])
		->extends('layouts.theme.app')
		->section('content');
	}

	public function setEntity($id, $type){

		$this->variation_id = $id;
		$this->product_prices = [];
		$this->entity_type = $type;

		$product_prices = ProductPrice::where(['product_id'=> $id, 'product_type' => $type])->get();
		if(!empty($product_prices)){

			foreach($product_prices as $pp){

				$list = $pp->priceList()->first();
				$this->product_prices[] = [
					'id' => $pp->id,
					'product_id' => $pp->product_id, 
					'price' => $pp->price, 
					'product_type' => $pp->product_type,
					'list_name' => (!empty($list)) ? $list->name : null
				];
			}
			unset($list, $product_prices);
		}
		$this->current_price = 0;
		$this->current_list = 0;
	}

	public function saveVariationStock($var_id, $stock)
	{
		$phv = ProductHasVariation::find($var_id);
		if(!empty($phv)){
			$phv->stock = (int) $stock;
			$phv->save();
			$this->mount();
		}
		//dd('id:' . $var_id, 'stock:' . $stock);
	}

	private function resetPriceValues()
	{
		$this->current_price = 0;
		$this->current_list = 0;
		$this->variation_id = 0;
	}

	public function savePrice()
	{
		if($this->current_price != 0 && $this->current_list != 0 && $this->variation_id != 0){
			ProductPrice::firstOrCreate([
				'price' => $this->current_price,
				'product_type'  => $this->entity_type, //'var' | 'prod'
				'price_list_id' => $this->current_list,
				'product_id'    => $this->variation_id
			]);
			$this->setEntity($this->variation_id, $this->entity_type);
			//$this->resetPriceValues();
		}

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
		//$this->emit('product-added', 'Producto Registrado');
		$this->Edit($product->id);
	}

	public $product_variations = [];

	public function Edit($id)
	{
		$this->product_variations = [];
		$record = Product::find($id);
		if(empty($record)){
			return redirect('/products');
		}
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

		$product_variations = ProductHasVariation::select('id', 'variation_name', 'stock')
									->where(['product_id'=>$id])->get();

		if(count($product_variations) == 0){
			ProductHasVariation::create([
				'variation_name' => 'variacion_1',
				'product_id'     => $id
			]);
			$product_variations = ProductHasVariation::select('id', 'variation_name', 'stock') // no lo toma recien creado
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
					'id'             => $pv['id'],
					'stock'			 => $pv['stock']
				];
				unset($options);
			}else{
				$this->product_variations[] = [
					'variation_name' => $pv->variation_name,
					'options'        => null,
					'id'             => $pv->id,
					'stock'			 => 0
				];
			}
		}
		//$this->emit('show-modal','Show modal!');
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

		//$this->resetUI();
		//$this->emit('product-updated', 'Producto Actualizado');
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

}
