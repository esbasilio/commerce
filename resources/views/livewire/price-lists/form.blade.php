 @include('common.modalHead')


<div class="row">

 @if($form_type==='add-product')

 <div class="col-sm-12 col-md-4">
 <div class="form-group">
  <label>Producto</label>
    <select wire:model='product_selected' class="form-control">
      <option value="0">Elegir</option>
      @foreach($product_list as $prod)
      <option value="{{$prod['id']}}">{{$prod['name']}}</option>
      @endforeach
    </select>
    @error('product') <span class="text-danger err">{{ $message }}</span> @enderror

    <div class="col-sm-12 col-md-8">
      <div class="form-group">
        <label>Precio</label>
          <input type="text" wire:model.lazy="current_product_price" class="form-control" placeholder="" >
        @error('current_product_price') <span class="text-danger er">{{ $message }}</span> @enderror
      </div>
    </div>
</div>
</div>

 @else
    <div class="col-sm-12 col-md-8">
      <div class="form-group">
        <label>Nombre</label>
          <input type="text" wire:model.lazy="list_name" class="form-control" placeholder="ej: lista_1" >
        @error('list_name') <span class="text-danger er">{{ $message }}</span> @enderror
      </div>
    </div>
 @endif
<!-- 
<div class="col-sm-12 col-md-4">
 <div class="form-group">
  <label>Código</label>
  <input type="text" wire:model.lazy="barcode" class="form-control" placeholder="ej: 02589" >
  @error('barcode') <span class="text-danger er">{{ $message }}</span> @enderror
</div>
</div>
 -->
</div>

@include('common.modalFooter')
