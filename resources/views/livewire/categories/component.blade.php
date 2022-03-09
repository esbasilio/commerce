<div class="row sales layout-top-spacing">

	<div class="col-sm-12 ">
		<div class="widget widget-chart-one">
			<div class="widget-heading">
				<h4 class="card-title"><b>{{$componentName}}</b> | {{$pageTitle}}</b></h4>			
				<ul class="tabs tab-pills">
					@can('category_create')
					<li><a href="javascript:void(0);" class="tabmenu bg-info" data-toggle="modal" data-target="#theModal">Agregar</a></li>
					@endcan
				</ul>
				

			</div>
			@role('Employee')
			@can('category_search')
				@include('common.searchbox')
			@endcan
			@endrole
			<div class="widget-content">
				


				<div class="table-responsive">
					<table  class="table table-bordered table-striped  mt-1">
						<thead class="text-white backgroud-table-th">
							<tr>
								<th class="table-th text-white">DESCRIPCIÓN</th>										
								<th class="table-th text-center text-white">IMAGEN</th>
								<th class="table-th text-center text-white">ACTIONS</th>

							</tr>
						</thead>
						<tbody>
							@foreach($categories as $category)
							<tr>
								<td><h6>{{$category->name}}</h6></td>
								<td class="text-center">
									@if($category->image != null)											

									<span>
										<img src="{{ asset('storage/categorias/'.$category->imagen) }}" 
										height="70" width="80" class="rounded" alt="no-image">
									</span>

									@endif
								</td>
								<td class="text-center">	
									@can('category_edit')							
									<a href="javascript:void(0);" wire:click="Edit({{$category->id}})" class="btn btn-success mtmobile" title="Edit">
										<i class="fas fa-edit"></i>
									</a>
									@endcan

									@can('category_destroy')
									<a href="javascript:void(0);" onclick="Confirm('{{$category->id}}')" 
										class="btn btn-danger" title="Delete">
										<i class="fas fa-trash"></i>
									</a>	
									@endcan										


								</td>

							</tr>

							@endforeach
						</tbody>
					</table>
					{{$categories->links()}}

					

				</div>

				

			</div>
		</div>
	</div>
	@include('livewire.categories.form')	
</div>





<script>
	document.addEventListener('DOMContentLoaded', function () {  
		
		window.livewire.on('category-added', Msg => {
			$('#theModal').modal('hide')
			noty(Msg)
		})	
		window.livewire.on('category-updated', Msg => {
			$('#theModal').modal('hide')
			noty(Msg)
		})		
		window.livewire.on('category-deleted', Msg => {			
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
			cancelButtonText: 'Cerrar',	
			cancelButtonColor: '#fff',					
			confirmButtonColor: '#3B3F5C',
			confirmButtonText: 'Aceptar',						
		}).then(function(result) {
			if (result.value) {                     
				window.livewire.emit('deleteRow', id)                       
				swal.close()  
			}
		})


		



	}
</script>