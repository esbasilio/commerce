<div wire:ignore.self>
	<div class="modal-dialog__modal-lg">
		<div class="modal-content">
			<div class="modal-header bg[0]-info">
				<h5 class="modal-title text[0]-white">
					<b>{{$componentName}}</b> | 
					@if(isset($componentDescription))
						{{$componentDescription}}
					@else
						{{ $selected_id > 0 ? 'EDITAR' : 'CREAR' }}
					@endif

				</h5>
				<h6 class="text-center text-warning" wire:loading>POR FAVOR ESPERE</h6>			
			</div>

			<div class="modal-body">




      <div class="row">
  <div class="col-sm-12 col-md-8">
   <div class="form-group">
    <label>Nombre</label>
      <input type="text" wire:model.lazy="name" class="form-control" placeholder="ej: Producto ..." >
    @error('name') <span class="text-danger er">{{ $message }}</span> @enderror
  </div>
</div>

<div class="col-sm-12 col-md-4">
 <div class="form-group">
  <label>Código</label>
    <input type="text" wire:model.lazy="barcode" class="form-control" placeholder="ej: 02589" >
  @error('barcode') <span class="text-danger er">{{ $message }}</span> @enderror
</div>
</div>

<div class="col-sm-12 col-md-4">
 <div class="form-group">
  <label>Costo</label>
    <input type="text" data-type='currency' wire:model.lazy="cost" class="form-control" placeholder="ej: 0.00" >
  @error('cost') <span class="text-danger er">{{ $message }}</span> @enderror
</div>
</div>

<div class="col-sm-12 col-md-4">
 <div class="form-group">
  <label>Precio</label>
    <input type="text" data-type='currency'  wire:model.lazy="price" class="form-control" placeholder="ej: 0.00" >
  @error('price') <span class="text-danger er">{{ $message }}</span> @enderror
</div>
</div>

<div class="col-sm-12 col-md-4">
 <div class="form-group">
  <label>Stock</label>
    <input type="number" wire:model.lazy="stock" class="form-control" placeholder="ej: 0" >
  @error('stock') <span class="text-danger er">{{ $message }}</span> @enderror
</div>
</div>

<div class="col-sm-12 col-md-4">
 <div class="form-group">
  <label>Alertas</label>
    <input type="number" wire:model.lazy="alerts" class="form-control" placeholder="ej: 10" >
  @error('alerts') <span class="text-danger er">{{ $message }}</span> @enderror
</div>
</div>
<div class="col-sm-12 col-md-4">
 <div class="form-group">
  <label>Categoría</label>
    <select wire:model='categoryid' class="form-control">
      <option value="Elegir" disabled >Elegir</option>
      @foreach($categories as $c)
      <option value="{{$c->id}}">{{$c->name}}</option>
      @endforeach
    </select>
    @error('categoryid') <span class="text-danger err">{{ $message }}</span> @enderror
</div>
</div>
<div class="col-sm-12 col-md-4">
 <div class="form-group">
  <label>Seccion</label>
    <select wire:model='almacen' class="form-control">
      <option value="">Elegir</option>
      @foreach($almacenes as $a)
      <option value="{{$a->id}}">{{$a->nombre}}</option>
      @endforeach
    </select>
    @error('almacen') <span class="text-danger err">{{ $message }}</span> @enderror
</div>
</div>

<div class="col-sm-12 col-md-12">
 <div class="form-group custom-file">
  <input type="file" class="custom-file-input" wire:model="image" accept="image/x-png, image/gif, image/jpeg"  class="form-control">
  <label class="custom-file-label" for="customFile">Imágen {{$image}}</label>
  @error('image') <span class="error">{{ $message }}</span> @enderror
</div>
</div>
<div class="col-sm-12 col-md-12">
______________________________________________________________________________
</div>

@if(!empty($sale_channels))
@foreach($sale_channels as $val)
<div class="col-sm-4 col-md-2">
  <div class="form-group">
    <label>{{$val['label_channel']}}</label>
    <input type="checkbox" wire:model.lazy="{{$val['slug']}}" class="form-check-input" style="position:relative; top:3; left:21px!important">
  </div>
</div>
@endforeach
<a href="javascript:void(0);" class="btn tabmenu bg-info" wire:click="setEntity({{$selected_id}}, 'prod')"
      data-toggle="modal" data-target="#modal-price-list" title="Price List">
      <b>+</b>
</a>
@endif

@if($selected_id > 0 && !empty($product_variations))

<div class="col-sm-12 col-md-12">
<table class="table table-bordered table-striped mt-1" style="border:none!important">
  <tr style="border:none!important">
    <th>Variacion</th>
    <th>Atributo</th>
    <th>Stock</th>
    <th>L. Precio</th>
  </tr>

  @foreach($product_variations as $var)
    <tr style="border-bottom:solid 1px #333">
        <td>
          <input type="text" class="form-control" 
                  id="update-variation{{$var['id']}}" style="width: 210px!important" 
                  wire:blur="updateVariation({{$var['id']}}, $('#update-variation{{$var['id']}}').val())"
                  value="{{$var['variation_name']}}">
        </td>
        <td>
          <table class="table">
          @foreach($var['options'] as $opt)
            <tr>
              <td>{{$opt['key']}}</td>
              <td>
                @if(empty($opt['value']))
                  @if(array_key_exists($opt['key'], $variation_list))
                    <select id="val{{$opt['id']}}{{$opt['attribute_id']}}" style="width: 150px!important"
                      wire:change="setAttrValue({{$opt['id']}}, $('#val{{$opt['id']}}{{$opt['attribute_id']}}').val())"
                      class="form-control">
                      <option value="0">Elegir</option>
                      @foreach($variation_list[$opt['key']]['options'] as $opts)
                        <option value="{{$opts}}">{{$opts}}</option>
                      @endforeach
                    </select>
                  @endif
                @else
                  {{$opt['value']}}
                @endif
              </td>
              <td>
              </td>
            </tr>
          @endforeach
          <tr>
            <td>
              <select id="nam{{$var['id']}}" style="width: 150px!important"
               wire:change="addAttrName({{$var['id']}}, $('#nam{{$var['id']}}').val())"
               class="form-control">
              <option value="0">Elegir</option>
              @foreach($variation_list as $a => $b)
                <option value="{{$b['id']}}">{{$a}}</option>
              @endforeach
              </select>
            </td>
            <td>
            </td>
          </tr>
          </table>
        </td>
        <td>
          <input type="number" style="width:100px!important" class="form-control" 
                  id="input_stock_{{$var['id']}}"
                  wire:blur="saveVariationStock({{$var['id']}}, $('#input_stock_{{$var['id']}}').val())"
              value="{{$var['stock']}}">
        </td>
        <td>
            <a href="javascript:void(0);" class="btn tabmenu bg-info" wire:click="setEntity({{$var['id']}}, 'var')"
                data-toggle="modal" data-target="#modal-price-list" title="Price List">
                    <b>+</b>
            </a>
        </td>
    </tr>
  @endforeach
  <tr>
      <td>
          <input type="text" class="form-control" id="add-variation" style="width: 210px!important" wire:blur="createVariation($('#add-variation').val())">
      </td>
      <td></td>
    </tr>
</table>
</div>
@endif
</div>
    </div>
    <div class="modal-footer">
        <a href="{{url('products/')}}" class="btn close-btn text-info">VOLVER</a>
        {{-- <button type="button" wire:click.prevent="resetUI()" class="btn close-btn text-info">CERRAR</button> --}}
        @if($selected_id == 0)
            <button type="button" wire:loading.remove wire:click.prevent="Store()" class="btn btn-success">GUARDAR</button>
        @elseif($selected_id >= 1)
            <button type="button" wire:loading.remove wire:click.prevent="Update()" class="btn btn-success close-modal">ACTUALIZAR</button>
        @endif
    </div>
</div>

@include('livewire.products.form-price-list')