<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\EntityRelation;
use App\Models\PaymentType;
//use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Product;

class PaymentTypeController extends Component
{
	use WithPagination;

    public $pageTitle, $componentName, $selected_id = 0, $search, $name, $percent = 0, $slug;
    private $pagination = 3;

    public function paginationView()
	{
		return 'vendor.livewire.bootstrap';
	}

	public function mount()
	{
		$this->pageTitle = 'Listado';
		$this->componentName = 'Tipos de pago';
        $this->form_type = '';

	}

	public function resetUI()
	{
		$this->name = '';
		$this->percent = 0;
		$this->slug = '';
	}

	public function render()
	{

        $ppls = PaymentType::orderBy('name','asc');

		if(strlen($this->search) > 0){
			$ppls->where('name', 'LIKE', "%{$this->search}%");
		}

        return view('livewire.payment-type.component', ['list' => $ppls->paginate($this->pagination)])
        ->extends('layouts.theme.app')
        ->section('content');
	}

    public function Store()
	{

		$rules = [
			'name' => 'required|unique:payment_types|min:3',
			'slug' => 'required|unique:payment_types|min:3|max:5'
		];

		$customMessages = [
			'name.required' => 'Nombre es requerido',
			'name.unique' => 'Ya existe el nombre',
			'name.min' => 'El nombre debe tener al menos 3 caracteres',

			'slug.required' => 'codigo es requerido',
			'slug.unique' => 'Ya existe el codigo',
			'slug.min' => 'El codigo debe tener al menos 3 caracteres',
			'slug.max' => 'El codigo debe tener un maximo de 5 caracteres'
		];

		$this->validate($rules, $customMessages);
		PaymentType::create([
			'name' => $this->name,
			'slug' => str_replace(' ', '', $this->slug),
			'percent' => (int)$this->percent
		]);

		$this->resetUI();
		$this->emit('payment-added', 'Metodo de pago registrado');
    }
}
