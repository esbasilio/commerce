<div class="row sales layout-top-spacing">

	<div class="col-sm-12 ">
		<div class="widget widget-chart-one">
			<div class="widget-heading">
				<h4 class="card-title"><b>{{$componentName}}</b> | {{$pageTitle}}</b></h4>			
				<ul class="tabs tab-pills">
					@can('role_create')
					<li><a href="javascript:void(0);" class="tabmenu bg-info" data-toggle="modal" data-target="#theModal">Agregar</a></li>
					@endcan
				</ul>

			</div>
			@can('role_search')
				@include('common.searchbox')
			@endcan
			<div class="widget-content">
				


				<div class="table-responsive">
					<table  class="table table-bordered table-striped  mt-1">
						<thead class="text-white backgroud-table-th">
							<tr>
								<th class="table-th text-white">ID</th>										
								<th class="table-th text-center text-white">DESCRIPCIÓN</th>
								<th class="table-th text-center text-white">ACTIONS</th>

							</tr>
						</thead>
						<tbody>
							@foreach($roles as $role)
							<tr>
								<td><h6>{{$role->id}}</h6></td>
								<td><h6 class="text-center">{{$role->name}}</h6></td>
								
								<td class="text-center">	
									@can('role_edit')										
									<a href="javascript:void(0);" wire:click="Edit({{$role->id}})" class="btn btn-success mbmobile" title="Edit">
										<i class="fas fa-edit"></i>
									</a>
									@endcan

									@can('role_destroy')
									<a href="javascript:void(0);" onclick="Confirm('{{$role->id}}')" 
										class="btn btn-danger" title="Delete">
										<i class="fas fa-trash"></i>
									</a>	
									@endcan										


								</td>

							</tr>

							@endforeach
						</tbody>
					</table>
					{{$roles->links()}}

					

				</div>

				

			</div>
		</div>
	</div>
	@include('livewire.roles.form')	
</div>





<script>
	document.addEventListener('DOMContentLoaded', function () {  

		//listen role-added event
		window.livewire.on('role-added', Msg => {
			$('#theModal').modal('hide')
			noty(Msg)
		})		
		window.livewire.on('role-updated', Msg => {
			$('#theModal').modal('hide')
			noty(Msg)
		})		
		window.livewire.on('role-deleted', Msg => {			
			noty(Msg)
		})
		window.livewire.on('role-exists', Msg => {			
			noty(Msg)
		})
		window.livewire.on('role-error', Msg => {			
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
				window.livewire.emit('destroy', id)                       
				swal.close()  
			}
		})


		



	}
</script>