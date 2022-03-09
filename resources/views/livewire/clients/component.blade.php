<div class="row sales layout-top-spacing">
	<div class="col-sm-12 ">
		<div class="widget widget-chart-one">
			<div class="widget-heading">
				<h4 class="card-title"><b>{{$componentName}}</b> | {{$pageTitle}}</b></h4>
				<ul class="tabs tab-pills">
					@can('client_create')
					<li><a href="javascript:void(0);" class="tabmenu bg-info" data-toggle="modal" data-target="#theModal">Agregar Cliente</a></li>
					@endcan
				</ul>
			</div>
			@can('user_search')
			@include('common.searchbox')
			@endcan
			<div class="widget-content">

				<div class="table-responsive">
					<table  class="table table-hover table-xl mb-0 table-de mt-1">
						<thead class="text-white backgroud-table-th">
							<tr>
								<th class="table-th text-white">USUARIO</th>
								<th class="table-th text-white text-center">TELÉFONO</th>
								<th class="table-th text-white text-center">EMAIL</th>
								<th class="table-th text-white text-center">PERFIL</th>
								<th class="table-th text-white text-center">ESTADO</th>
								<th class="table-th text-white text-center" width="8%">IMAGEN</th>
								<th class="table-th text-white text-center">ACCIONES</th>

							</tr>
						</thead>
						<tbody>
							@foreach($data as $r)
							<tr>
								<td><h6>{{$r->name}}</h6></td>
								<td class="text-center">
									<h6>{{$r->phone}}</h6>
								</td>
								<td class="text-center"><h6>{{$r->email}}</h6>	</td>
								<td class="text-center"><h6>{{$r->profile}}</h6></td>
								<td class="text-center">
									<span class="badge {{$r->status =='Activo' ? 'badge-success' : 'badge-danger' }} text-uppercase">{{$r->status}}</span>
								</td>
								<td class="text-center">
									@if($r->image != null)
									<img class="card-img-top img-fluid"
									src="{{ asset('storage/users/'.$r->image) }}"
									>
									@endif
								</td>
								<td class="text-center">
									@if($r->email !='luisfaax@gmail.com')

									<a href="javascript:void(0);" wire:click="edit({{$r->id}})" class="btn btn-success mbmobile" title="Edit">
										<i class="fas fa-edit"></i>
									</a>
									@can('user_destroy')
									<a href="javascript:void(0);" onclick="Confirm('{{$r->id}}')"
										class="btn btn-danger" title="Delete">
										<i class="fas fa-trash"></i>
									</a>
									@endcan
									@endif
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					{{ $data->links() }}
				</div>
			</div>
		</div>
	</div>
	@include('livewire.clients.form')
</div>

<script>
	document.addEventListener('DOMContentLoaded', function () {

		//listen user-added event
		window.livewire.on('user-added', Msg => {
			$('#theModal').modal('hide')
			noty(Msg)
		})
		//listen user-updated event
		window.livewire.on('user-updated', Msg => {
			$('#theModal').modal('hide')
			noty(Msg)
		})
		//listen user-deleted event
		window.livewire.on('user-deleted', Msg => {
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
		})
		window.livewire.on('user-withsales', Msg => {
			noty(Msg)
		})

	})


	function Confirm(id)
	{
		swal({
			title: 'CONFIRMAR',
			text: '¿DESEAS ELIMINAR EL REGISTRO?',
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3B3F5C',
			cancelButtonColor: '#fff',
			confirmButtonText: 'Aceptar',
			cancelButtonText: 'Cerrar',
		}).then(function(result) {
			if (result.value) {
				window.livewire.emit('deleteRow', id)
				swal.close()
			}
		})
	}
</script>
