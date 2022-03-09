<?php

namespace App\Http\Livewire;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Productos_fabrica;
use App\Models\Categorias_fabrica;
use App\Models\Ventas_fabrica;
use App\Models\Detalle_ventas_fabricas;

class VentasController extends Component
{

  use WithPagination;
  use WithFileUploads;

  public $name,$barcode,$cost,$price,$stock,$alerts,$categoryid, $search, $image, $selected_id, $pageTitle,$componentName,$comercio_id,$data_carrito, $carrito ;
  private $pagination = 25;

  public function mount()
  {
    $this->pageTitle = 'Listado';
    $this->componentName = 'Productos';
    $this->categoryid = 'Elegir';
  }

  public function render()
  {

    if(Auth::user()->comercio_id != 1)
    $comercio_id = Auth::user()->comercio_id;
    else
    $comercio_id = Auth::user()->id;
    if(strlen($this->search) > 0)
      $products = Productos_fabrica::join('categorias_fabricas as c','c.id','productos_fabricas.category_id')
      ->select('productos_fabricas.*','c.name as category')
      ->where('productos_fabricas.name', 'like', '%' . $this->search . '%')
      ->orWhere('productos_fabricas.barcode', 'like', '%' . $this->search . '%')
      ->orWhere('c.name', 'like', '%' . $this->search . '%')
      ->orderBy('productos_fabricas.name','asc')
      ->paginate($this->pagination);
    else
      $products = Productos_fabrica::join('categorias_fabricas as c','c.id','productos_fabricas.category_id')
      ->select('productos_fabricas.*','c.name as category')
      ->where('productos_fabricas.comercio_id', 'like', $comercio_id)
      ->orderBy('productos_fabricas.name','asc')
      ->paginate($this->pagination);

    return view('livewire.ventas.component',[
      'data' => $products,
      'categorias_fabrica' => Categorias_fabrica::orderBy('name','asc')->get()
    ])
    ->extends('layouts.theme.app')
    ->section('content');
  }

  public function Carrito()
  {
    $CartCollection = \Ventas_fabrica::getContent();
    dd($CartCollection);
    return view('livewire.vercarrito.component',[
      'CartCollection' => $CartCollection
    ])
    ->extends('layouts.theme.app')
    ->section('content');
  }

  public function add(Request$request){
       \Carrito::add(array(
           'id' => $request->id,
           'name' => $request->name,
           'price' => $request->price,
           'quantity' => $request->quantity,
           'cost' => $request->quantity,
           'attributes' => array(
            'image' => $request->img,
            'slug' => $request->slug
           )
       ));
       return redirect()->route('ventas-fabricas')->with('success_msg', 'Item is Added to Cart!');
   }


}
