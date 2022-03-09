<div class="row sales layout-top-spacing">

	<div class="col-sm-12 ">
		<div class="widget widget-chart-one">
			<div class="widget-heading">
				<h4 class="card-title"><b>{{$componentName}}</b> | {{$pageTitle}} </h4>
				<ul class="tabs tab-pills">
					@can('price_list_create')
					<li><a href="javascript:void(0);" 
							wire:click="setForType('new-list')"
							class="tabmenu bg-info" 
							data-toggle="modal" 
							data-target="#theModal">Agregar
						</a>
					</li>
					@endcan
				</ul>
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
								<th class="table-th text-white">NOMBRE</th>
								<th class="table-th text-white">ATRIBUTOS</th>
							</tr>
						</thead>
						<tbody>
							@foreach($list as $item)
							<tr>
								<td><h6>{{$item->id}}</h6></td>
								<td><h6>{{$item->name}}</h6></td>
								<td>
									<button class="btn btn-info" 
											data-toggle="modal" 
											data-target="#theModal"
											wire:click="setForType('add-product', {{$item}})">+</button>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					{{$list->links()}}
				</div>
			</div>
		</div>
		@include('livewire.price-lists.form')
	</div>
</div>
<script>
	document.addEventListener('DOMContentLoaded', function () {
		//events
		window.livewire.on('product-price-list-added', Msg => {
			$('#theModal').modal('hide')
			noty(Msg)
		})

	})
</script>