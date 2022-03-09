<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\ProductPriceList;
use App\Models\EntityRelation;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Http\Request;
use App\Models\Variation;
use App\Models\Product;
use Livewire\Component;

class ProductPriceController extends Component
{
	use WithPagination;
	use WithFileUploads;

	public $componentName, $pageTitle, $selected_id=0, $list_name, $product_list = [], $current_product_price,
	$product_selected, $channel_options = [];
	private $pagination = 3;

	public function paginationView()
	{
		return 'vendor.livewire.bootstrap';
	}

	public function mount()
	{
		$this->current_product_price = 0;
		$this->componentName = 'Precios';
		$this->pageTitle = 'Listado';
		$this->product_selected = 0;
		$this->product_list = null;
        $this->list_name = '';
		$this->form_type = '';
		$this->channel_options = [];
 	}

	public $form_type = '';

	public function setForType($type, $channel_options = null)
	{
		$this->form_type = $type;
		if($channel_options != null){
			$this->channel_options = [
				'name' => $channel_options['name'],
				'id' => $channel_options['id']
			];

		}
	}

	public function render()
	{

        $ppls = ProductPriceList::orderBy('name','asc')
				->paginate($this->pagination);

		$comercio_id = Auth::user()->comercio_id;
		$channel_id = null;

		if(Auth::user()->profile != 'Admin'){
			$channel = EntityRelation::where(['sale_channel' => Auth::user()->profile])->first();
			if(!empty($channel)){
				$channel_id = $channel->id;
			}
			//$this->setSelectedProducts();
		}
		// if($channel_id!=null){
		// 	$products = Product::join('categories as c','c.id','products.category_id')
		// 	->join('seccionalmacens as a','a.id','products.seccionalmacen_id')
		// 	->join('product_prices as pp', 'pp.product_id', 'products.id')
		// 	->select('products.id', 'products.name', 'products.comercio_id', 'products.barcode', 
		// 	'products.cost', 'pp.price', 'products.stock', 'products.alerts', 
		// 	'products.image', 'products.seccionalmacen_id', 'products.category_id', 
		// 	'products.created_at', 'products.updated_at','c.name as category','a.nombre as almacen')
		// 	->where('products.comercio_id', '=', $comercio_id)
		// 	->where('pp.channel_id', '=', $channel->id)
		// 	->orderBy('products.name','asc')
		// 	->paginate($this->pagination);
		// }else{
		$products = Product::join('categories as c','c.id','products.category_id')
			->join('seccionalmacens as a','a.id','products.seccionalmacen_id')
			->select('products.*','c.name as category','a.nombre as almacen')
			->where('products.comercio_id', '=', $comercio_id)
			->orderBy('products.name','asc')->get();
			//->paginate($this->pagination);
		//}

		foreach($products as $prod){
			$this->product_list[] = [ 'id' => $prod->id, 'name' => $prod->name];
		}

        return view('livewire.price-lists.component', ['list' => $ppls /*, 'products'=>$products*/])
        ->extends('layouts.theme.app')
        ->section('content');

	}

	public function resetUI()
	{
		$this->current_product_price = 0;
		$this->channel_options = [];
		$this->product_selected = 0;
		$this->product_list = null;
        $this->list_name = '';
		$this->form_type = '';
	}

	public function Store()
	{

		if($this->form_type == 'new-list'){

			if(trim($this->list_name)!== ''){
				ProductPriceList::firstOrCreate(
					['name'=>$this->list_name]
				);
			}

		}elseif($this->form_type == 'add-product'){
			dd('current_price:' . $this->current_product_price, 
			'product:' . $this->product_selected, 
			$this->channel_options);
		}

        $this->resetUI();
        $this->emit('product-price-list-added', 'Item Registrado');
	}
}
