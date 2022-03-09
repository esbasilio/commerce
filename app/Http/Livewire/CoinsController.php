<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Denomination;

class CoinsController extends Component
{
	use WithPagination;
	use WithFileUploads;

	public $type, $value, $image, $search, $selected_id, $pageTitle,$componentName;
	private $pagination = 6;


	public function paginationView()
	{
		return 'vendor.livewire.bootstrap';
	}
	
	public function mount()
	{
		$this->type = 'Elegir';
		$this->pageTitle = 'Listado';
		$this->componentName = 'Denominaciones';			
	}

	public function render()
	{
		return view('livewire.coins.component',[
			'coins' => Denomination::paginate($this->pagination)
		])
		->extends('layouts.theme.app')
		->section('content');
	}


	public function Store()
	{
		//validation rules
		$rules = [
			'type' => 'required|not_in:Elegir',			
			'value' => 'required',
		];		

		//custom messages
		$customMessages = [
			'type.required' => 'El tipo es requerido',
			'type.not_in' => 'Elige un tipo válido',
			'value.required' => 'El valor requerido',
			'value.unique' => 'Ya existe el valor'			
		];

		//execute validate
		$this->validate($rules, $customMessages);

		$valid = Denomination::where('type', $this->type)->where('value', $this->value)->first();
		if($valid != null) {			
			$this->addError('value', "Ya existe la denominación {$this->type} {$this->value}");
			return;
		}
		
		//insert
		$denomination =  Denomination::create([
			'type' => $this->type,
			'value' => $this->value
		]);


		//save image
		$customFileName;
		if($this->image)
		{
			$customFileName	 = uniqid() . '_.' . $this->image->extension();	
			$this->image->storeAs('public/denominations', $customFileName);
			$denomination->image = $customFileName;
			$denomination->save();
		}

		// clear inputs
		$this->resetUI();		
		$this->emit('denomination-added', 'Denominación Registrada');
	}



	public function Edit($id)
	{
		$record = Denomination::find($id);				
		$this->selected_id = $record->id;
		$this->type = $record->type;
		$this->value = $record->value;
		$this->image = null;
		
		$this->emit('show-modal','Show modal!');
	}

	public function Update()
	{
 		//validation rules
		$rules = [
			'type' => 'required|not_in:Elegir',
			'value' => "required|unique:denominations,value,{$this->selected_id}"
		];
		

		//custom messages
		$customMessages = [
			'type.required' => 'El tipo es requerido',
			'type.not_in' => 'Elige un tipo válido',
			'value.unique' => 'Ya existe el valor'			
		];

		//execute validate
		$this->validate($rules, $customMessages);


		//update
		$denomination = Denomination::find($this->selected_id);    
		$denomination->update([
			'type' => $this->type,
			'value' => $this->value
		]);  


		//save image
		$customFileName;
		if($this->image)
		{
			$customFileName	 = uniqid() . '_.' . $this->image->extension();	
			$this->image->storeAs('public/denominations', $customFileName);
			$imageName = $denomination->image;

			$denomination->image = $customFileName;
			$denomination->save();
				
			if($imageName !=null)  {
				if (file_exists('storage/denominations/'. $imageName)) {
					unlink('storage/denominations/'. $imageName);	
				}
			}
		}

		$this->resetUI();
		$this->emit('denomination-updated', 'Denominación Actualizada');
	}


	// reset values inputs
	public function resetUI()
	{
		$this->type ='Elegir';		
		$this->value ='';		
		$this->image = null;
		$this->search ='';
		$this->selected_id = 0;
		
	}


	//events listeners
	protected $listeners = [
		'deleteRow'   => 'Destroy'		
	];  



	public function Destroy($id)
	{
		if ($id) { 
			$denomination = Denomination::find($id);
			$imageName = $denomination->image;			
			
			$denomination->delete();
			if($imageName !=null)	unlink('storage/denominations/'. $imageName);


			$this->resetUI();
			$this->emit('denomination-deleted', 'Denominación Eliminada');
		}
	}



}
