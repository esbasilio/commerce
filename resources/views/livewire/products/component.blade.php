<div class="row sales layout-top-spacing">

	<div class="col-sm-12 ">
		<div class="widget widget-chart-one">
			<div class="widget-heading">
				<h4 class="card-title"><b>{{$componentName}}</b> | {{$pageTitle}} </h4>
				<ul class="tabs tab-pills">
					@can('product_create')
					<li><a href="{{url('products/add')}}" class="tabmenu bg-info">Agregar</a></li>
					{{--<li><a href="javascript:void(0);" class="tabmenu bg-info" data-toggle="modal" data-target="#theModal">Agregar(M)</a></li>--}}
					@endcan

					@can('order_select')
					<li><a href="javascript:void(0);" wire:click="unselectProducts()" class="tabmenu bg-info" onclick="unselect_all()">Desceleccionar todo</a></li>
					<li><a href="javascript:void(0);" wire:click="finishOrder()" class="tabmenu bg-success">Finalizar pedido</a></li>
					@endcan
				</ul>
			</div>
			@can('product_search')
				@include('common.searchbox')
			@endcan
			<div class="widget-content">

				<div class="table-responsive">
					<table  class="table table-bordered table-striped  mt-1">
						<thead class="text-white backgroud-table-th">
							<tr>
								<th class="table-th text-white">DESCRIPCIÓN</th>
								<th class="table-th text-center text-white">BARCODE</th>
								<th class="table-th text-center text-white">CATEGORÍA</th>
								<th class="table-th text-center text-white">PRECIO</th>
								<th class="table-th text-center text-white">STOCK</th>
								<th class="table-th text-center text-white">ALMACEN</th>
								<th class="table-th text-center text-white">INV.MIN</th>
								<th class="table-th text-center text-white">IMAGEN</th>
								<th class="table-th text-center text-white">ACTIONS</th>

							</tr>
						</thead>
						<tbody>
							@foreach($data as $product)
							<tr>
								<td><h6>{{$product->name}}</h6></td>
								<td class="text-center"><h6>{{$product->barcode}}</h6></td>
								<td class="text-center"><h6>{{$product->category}}</h6></td>
								<td class="text-center"><h6>${{number_format($product->price,2)}}</h6></td>
								<td class="text-center">
									<h6>
										{{$product->stock}}
									</h6>
								</td>
									<td class="text-center"><h6>{{$product->almacen}}</h6></td>
								<td class="text-center"><h6>{{$product->alerts}}</h6></td>
								<td class="text-center">
									@if($product->image != null)

									<span>
										<img src="{{ asset('storage/products/'.$product->image) }}"
										height="70" width="80" class="rounded" alt="no-image">
									</span>

									@endif
								</td>
								<td class="text-center">
									@can('product_edit')

									<a href="{{url('/products/edit/' . $product->id)}}" class="btn btn-info mbmobile" title="Edit">
										<i class="fas fa-edit"></i>
									</a>

									{{--<a href="javascript:void(0);" wire:click="Edit({{$product->id}})" class="btn btn-success mbmobile" title="Edit">
										<i class="fas fa-edit"></i>
									</a>--}}
									@endcan
									@can('product_destroy')
									<a href="javascript:void(0);" onclick="Confirm('{{$product->id}}')"
										class="btn btn-danger" title="Delete">
										<i class="fas fa-trash"></i>
									</a>
									@endcan
									@can('order_select')
										<input data-toggle="modal" data_target="#modalquantity"
											type="checkbox" 
											wire:click="selectProduct({{$product}}, $('#ch{{$product->id}}').is(':checked'))"
											id="ch{{$product->id}}"
											@if(array_key_exists($product->id, $selected_products))
												checked=true
											@endif
											title="Seleccionar producto"
										>
									@endcan
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					{{$data->links()}}
				</div>
			</div>
		</div>
		@can('order_select')
			@include('livewire.products.form-quantity')
		@else
			@include('livewire.products.form')
		@endcan
	</div>
</div>

<script>
	document.addEventListener('DOMContentLoaded', function () {

		//events
		window.livewire.on('show-quantity-form', Msg => {
			$('#modalquantity').modal('show')
		})
		window.livewire.on('product-added', Msg => {
			$('#theModal').modal('hide')
			noty(Msg)
		})
		window.livewire.on('product-updated', Msg => {
			$('#theModal').modal('hide')
			noty(Msg)
		})
		window.livewire.on('product-deleted', Msg => {
			noty(Msg)
		})
		window.livewire.on('hide-modal', Msg => {
			$('#theModal').modal('hide')
		})
		window.livewire.on('show-modal', Msg => {
			$('#theModal').modal('show')
		})
		window.livewire.on('order-added', Msg => {
			noty(Msg)
		})
		$('#theModal').on('hidden.bs.modal', function (e) {
			$('.er').css('display','none')
			console.log('display:none')
		})
	})

	function Confirm(id)
	{
		swal({
			title: 'CONFIRMAR',
			text: '¿DESEAS ELIMINAR EL REGISTRO?',
			type: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Aceptar',
			cancelButtonText: 'Cancelar',
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			padding: '2em'
		}).then(function(result) {
			if (result.value) {
				window.livewire.emit('deleteRow', id)
				swal.close()
			}
		})
	}

	function unselect_all()
	{
		$('input').filter(':checkbox').prop('checked',false);
	}
</script>
