<div class="row sales layout-top-spacing">

	<div class="col-sm-12 ">
		<div class="widget widget-chart-one">
			<div class="widget-heading">
				<h4 class="card-title"><b>{{$componentName}}</b> | {{$pageTitle}} </h4>
			</div>
			@can('order_search')
				@include('common.searchbox')
			@endcan
			<div class="widget-content">
				<div class="table-responsive">
					<table class="table table-bordered table-striped mt-1">
						<thead class="text-white backgroud-table-th">
							<tr>
								<th class="table-th text-white">ID</th>
								<th class="table-th text-white">ESTADO</th>
								<th class="table-th text-white">TIPO PAGO</th>
								<th class="table-th text-center text-white">TOTAL</th>
								<th class="table-th text-center text-white">FECHA</th>
								<th class="table-th text-center text-white">ACCIONES</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $order)
							<tr>
								<td><h6>{{$order->id}}</h6></td>
								<td>
								@can('order_change_status')
								<select wire:change="setOrderStatus({{$order->id}}, $('#sel{{$order->id}}').val())"
									id="sel{{$order->id}}"
									class="form-control order_status" 
									style="background-color:{{$order->status->color}}">
									<option value="Elegir" disabled >Elegir</option>
									@foreach($statuses as $s)
										<option value="{{$s->id}}" 
											@if($s->name == $order->status->name) 
												{{'selected'}} 
											@endif
										>{{$s->name}}</option>
									@endforeach
								</select>
								@else
								<h6 style="color:{{$order->status->color}}!important">{{$order->status->name}}</h6>
								@endcan
								</td>
								<td><h6>{{$order->payment_type->name}}</h6></td>
								<td class="text-center"><h6>{{$order->total}}</h6></td>
								<td class="text-center"><h6>{{$order->created_at->format('d/m/Y H:i:s')}}</h6></td>
								<td class="text-center">
								@can('order_show_detail')
									<a href="javascript:void(0);" wire:click="showOrderDetails({{$order->id}})" 
										class="btn btn-success mbmobile" title="Detalle {{$order->id}}">
										<i class="fas fa-search"></i>
									</a>
								@endcan
									<a href="{{url('order/pdf/export', $order->id)}}"  
										class="btn btn-info mbmobile" title="Detalle"
										target="_blank">
										<i class="fas fa-print"></i>
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		@include('livewire.orders.form')
	</div>
</div>


<script>
	document.addEventListener('DOMContentLoaded', function () {

		//events
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
</script>
