<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Models\EntityRelation;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Preventist;
use App\Models\Identification;
use App\Models\Franchise;
use App\Models\Contact;
use Livewire\Component;
use App\Models\Address;
use App\Models\Client;
use App\Models\User;
use App\Models\Sale;

class UserController extends Component
{
	use WithPagination;
	use WithFileUploads;

	public $name,$phone,$email, $status,$profile,$image,$password, $selected_id, $fileLoaded, $role;
	public $pageTitle, $componentName, $search, $entity_relation, $entity_fields = [], $entity_address = [], $entity_contact = [], $entity_identification = [];
	private $pagination = 20;

	public function paginationView()
	{
		return 'vendor.livewire.bootstrap';
	}

	public function mount()
	{
		$this->pageTitle = 'Listado';
		$this->componentName = 'Usuarios';
		$this->status = 'Elegir';
		$this->profile = 'Elegir';
	}


	public function render()
	{
		//dd(auth()->user()->hasRole([3,6,9]));
		if(strlen($this->search) > 0)
			$data = User::where('name', 'like', '%' . $this->search .'%')
		->select('*')
		->where('users.comercio_id', 'like', Auth::user()->id )
		->orderBy('name','asc')->paginate($this->pagination);
		else
		$data = User::select('*')
		->where('users.comercio_id', 'like', Auth::user()->comercio_id )
		->orderBy('name','asc')->paginate($this->pagination);

		return view('livewire.users.component',[
			'data' => $data,
			'roles' => Role::orderBy('name','asc')->get()
		])
		->extends('layouts.theme.app')
		->section('content');
	}

	public function updatingSearch()
	{
		$this->gotoPage(1);
		 //$this->resetPage();
	}

	//resetUI
	public function resetUI()
	{
		$this->name ='';
		$this->email ='';
		$this->password ='';
		$this->phone ='';
		$this->image ='';
		$this->profile ='Elegir';
		$this->status ='Elegir';
		$this->search ='';
		$this->selected_id = 0;
		$this->entity_relation = '';
		$this->entity_fields = [];
		$this->entity_address = [];
		$this->entity_contact = [];
		$this->entity_identification = [];
	}

	//edit
	public function edit($id)
	{
		$this->resetUI();
		$record = User::find($id);
		$this->selected_id = $record->id;
		$this->name = $record->name;
		$this->phone = $record->phone;
		$this->profile = $record->profile;
		$this->status = $record->status;
		$this->email = $record->email;
		//$this->password = $record->password;

		if(trim($this->profile) != ''){
			$er = EntityRelation::join('roles as r','r.slug','entity_relations.role_slug')
			->where('r.name', $this->profile)->first();
			if(!empty($er)){

				$this->entity_relation = $er->entity;
				$entity = $this->entity_relation::whereUserId($id)->first();

				if(empty($entity)){

					$address = Address::create([
						'address'           => '-',
						'address_number'    => '0',
						'reference'         => '-'
					]);

					$identification = Identification::create([
						'number'    => null,
						'cbu'       => null,
						'cuil'      => null,
						'cuit'      => null
					]);

					$contact = Contact::whereEmail($this->email)->first();
					if(empty($contact)){
						$contact = Contact::create([
							'web_site'  => null,
							'phone'     => $this->phone,
							'fax'       => null,
							'email'     => $this->email
						]);
					}

					$entity = new $this->entity_relation;
					$entity->user_id            = $id;
					$entity->identification_id  = $identification->id;
					$entity->address_id 		= $address->id;
					$entity->contact_id 		= $contact->id;

					if(in_array('name', $entity->getFillable())){
						$entity->name       	= '-';
					}
					if(in_array('last_name', $entity->getFillable())){
						$entity->last_name  	= '-';
					}

					if(in_array('business_name', $entity->getFillable())){
						$entity->business_name = '-';
					}
					if(in_array('branch_number', $entity->getFillable())){
						$entity->branch_number = '00';
					}

					if(in_array('references', $entity->getFillable())){
						$entity->references 	= '';
					}

					if(in_array('shop_id', $entity->getFillable())){
						$entity->shop_id 		= Auth()->user()->getEnityRelationship('id');
					}

					$entity->save();
				}
				$this->entity_fields = $entity->toArray();
				$this->entity_address = $entity->address()->first()->toArray();
				$this->entity_contact = $entity->contact()->first()->toArray();
				$this->entity_identification = $entity->identification()->first()->toArray();
			}
		}
		$this->emit('show-modal','open!');
	}

	//events listeners
	protected $listeners = [
		'deleteRow'   => 'destroy',
		'resetUI' =>'resetUI',
	];


	//create method
	public function Store()
	{
		//if(Auth::user()->comercio_id != 1)
		$comercio_id = Auth::user()->comercio_id;
		//else
		//$comercio_id = Auth::user()->id;

		//validate
		$rules =[
			'name' => 'required|min:3',
			'email' => 'required|unique:users|email',
			'status' => 'required|not_in:Elegir',
			'profile' => 'required|not_in:Elegir',
			'password' => 'required|min:3'
		];

		$messages = [
			'name.required' => 'Ingresa el nombre',
			'name.min' => 'El nombre de usuario debe tener al menos 3 caracteres',
			'email.required' => 'Ingresa el correo electrónico',
			'email.unique' => 'El correo ya está registrado en sistema',
			'email.email' => 'El email es inválido',
			'status.required' => 'Selecciona el estatus para el usuario',
			'profile.required' => 'Selecciona el perfil para el usuario',
			'password.required' => 'Ingresa la contraseña',
			'password.min' => 'La contraseña debe tener al menos 3 caracteres',
			'profile.not_in' => 'Elige el perfil',
			'status.not_in' => 'Elige el estatus',
		];


		$this->validate($rules, $messages);


		//insert
		$user =  User::create([
			'name' => $this->name,
			'comercio_id' => $comercio_id,
			'email' => $this->email,
			'phone' => $this->phone,
			'status' => $this->status,
			'profile' => $this->profile,
			'password' => bcrypt($this->password)
		]);

		//syn role
		$user->syncRoles($this->profile);


		//save image
		$customFileName;
		if($this->image)
		{
			$customFileName	 = uniqid() . '_.' . $this->image->extension();
			$this->image->storeAs('public/users', $customFileName);
			$user->image = $customFileName;
			$user->save();
		}

		$this->resetUI();
		$this->emit('user-added', 'Usuario Registrado Correctamente');

	}

	//update method
	public function Update()
	{
		$rules =[
			'email' => "required|email|unique:users,email,{$this->selected_id}",
			'status' => 'required|not_in:Elegir',
			'profile' => 'required|not_in:Elegir',
			'name' => 'required|min:3',
			//'password' => 'required|min:3'
		];

		$messages = [
			'name.required' => 'Ingresa el nombre',
			'name.min' => 'El nombre de usuario debe tener al menos 3 caracteres',
			'email.required' => 'Ingresa el correo electrónico',
			'email.unique' => 'El correo ya está registrado en sistema',
			'email.email' => 'El email es inválido',
			'status.required' => 'Selecciona el estatus para el usuario',
			'profile.required' => 'Selecciona el perfil para el usuario',
			'password.required' => 'Ingresa la contraseña',
			//'password.min' => 'La contraseña debe tener al menos 3 caracteres',
			'profile.not_in' => 'Elige el perfil',
			'status.not_in' => 'Elige el estatus',
		];

		$this->validate($rules, $messages);

		//update
		$user = User::find($this->selected_id);
		$user->update([
			'name' => $this->name,
			'email' => $this->email,
			'phone' => $this->phone,
			'status' => $this->status,
			'profile' => $this->profile,
			//'password' => bcrypt($this->password)
		]);

		//syn role
		$user->syncRoles($this->profile);


		//save image
		$customFileName;
		if($this->image)
		{
			$customFileName	 = uniqid() . '_.' . $this->image->extension();
			$this->image->storeAs('public/users', $customFileName);
			$imageName = $user->image;

			$user->image = $customFileName;
			$user->save();

			if($imageName !=null)  {
				if (file_exists('storage/users/'. $imageName)) {
					unlink('storage/users/'. $imageName);
				}
			}
		}

		$er = EntityRelation::join('roles as r','r.slug','entity_relations.role_slug')
		->where('r.name', $this->profile)->first();
		if(!empty($er)){

			$this->entity_relation = $er->entity;

			$entity = $this->entity_relation::whereUserId($this->selected_id)->first();
	
			if(!empty($entity)){
				if(in_array('name', $entity->getFillable())){
					$entity->name       	= $this->entity_fields['name'];
				}
				if(in_array('last_name', $entity->getFillable())){
					$entity->last_name  	= $this->entity_fields['last_name'];
				}
	
				if(in_array('business_name', $entity->getFillable())){
					$entity->business_name = $this->entity_fields['business_name'];
				}

				if(in_array('branch_number', $entity->getFillable())){
					$entity->branch_number = $this->entity_fields['branch_number'];
				}
				$entity->save();
				$address = $entity->address()->first();
				$address->address = $this->entity_address['address'];
				$address->address_number = $this->entity_address['address_number'];
				$address->reference = $this->entity_address['reference'];
				$address->save();

				$identification = $entity->identification()->first();
				$identification->number = $this->entity_identification['number'];
				$identification->cbu = $this->entity_identification['cbu'];
				$identification->cuit = $this->entity_identification['cuit'];
				$identification->cuil = $this->entity_identification['cuil'];
				$identification->save();

				$contact = $entity->contact()->first();
				$contact->phone = $this->entity_contact['phone'];
				$contact->fax = $this->entity_contact['fax'];
				$contact->email = $this->entity_contact['email'];
				$contact->web_site = $this->entity_contact['web_site'];
				$contact->save();
			}
		}

		$this->resetUI();
		$this->emit('user-updated', 'Usuario Actualizado Correctamente');
	}

	//destroy
	public function destroy($id)
	{
		if ($id) {
			$user = User::find($id);
			$sales = Sale::where('user_id', $id)->count();
			if($sales > 0) {
				$this->emit('user-withsales', 'No es posible eliminar el usuario porque tiene ventas relacionadas');
			} else {
				$user->delete();
				$this->resetUI();
				$this->emit('user-deleted', 'Usuario Eliminado');
			}
		}

	}

	public function profile()
	{
		dd(Auth::user()->id, Auth::user()->password, Auth::user()->getEnityRelationship('id'));
	}
}
