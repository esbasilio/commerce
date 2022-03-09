<?php

namespace App\Http\Livewire;
//use Illuminate\Http\Request;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Variation;
use Livewire\Component;

class VariationController extends Component
{

	use WithPagination;
	use WithFileUploads;

	public $componentName, $pageTitle;
	private $pagination = 3;

	public function paginationView()
	{
		return 'vendor.livewire.bootstrap';
	}

	public function mount()
	{
		$this->pageTitle = 'Listado';
		$this->componentName = 'Variaciones';
	}


	public function render()
	{

        $variations = Variation::orderBy('variations.name','asc')
				->paginate($this->pagination);

        return view('livewire.variations.component', ['variations' => $variations])
        ->extends('layouts.theme.app')
        ->section('content');
		// if(strlen($this->search) > 0)
		// 	$data = User::where('name', 'like', '%' . $this->search .'%')
		// ->select('*')
		// ->where('users.comercio_id', 'like', Auth::user()->id )
		// ->orderBy('name','asc')->paginate($this->pagination);
		// else
		// $data = User::select('*')
		// ->where('users.comercio_id', 'like', Auth::user()->comercio_id )
		// ->orderBy('name','asc')->paginate($this->pagination);

		// return view('livewire.users.component',[
		// 	'data' => $data,
		// 	'roles' => Role::orderBy('name','asc')->get()
		// ])
		// ->extends('layouts.theme.app')
		// ->section('content');
	}

	public function updatingSearch()
	{

	}

	//resetUI
	public function resetUI()
	{

	}

	public function addAttr($id, $val)
	{
		$val = str_replace(' ','', $val);

		if($val ==! ''){
			$vidriation = Variation::find($id);
			$attrs = json_decode($vidriation->options, true);

			if(!in_array($val, $attrs)){
				$attrs[] = $val;
				$vidriation->options = json_encode($attrs);
				$vidriation->save();
			}
		}
	}

	public function removeAttr($id, $val)
	{
		$vidriation = Variation::find($id);
		$attrs = json_decode($vidriation->options, true);

		$key = array_search($val, $attrs);
		if (false !== $key) {
			unset($attrs[$key]);
		}
		$vidriation->options = json_encode($attrs);
		$vidriation->save();
	}

	public function addVariation($name)
	{

		$name = str_replace(' ','', $name);

		if($name ==! ''){
			$variation = Variation::where(['name'=>$name])->first();
			if(empty($variation)){
				Variation::create([
					'name' 	  => $name,
					'options' => '[]'
				]);
			}
		}
	}

	public function removeVariation($id)
	{
		// if se puede eliminar 
		$variation = Variation::find($id);
		$variation->delete();

	}
}
