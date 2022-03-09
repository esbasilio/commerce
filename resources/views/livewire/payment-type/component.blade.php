<div class="row sales layout-top-spacing">

	<div class="col-sm-12">
		<div class="widget widget-chart-one" style="border-radius:none!important">
			<div class="widget-heading">
				<h4 class="card-title"><b>{{$componentName}}</b> | {{$pageTitle}} </h4>
				<ul class="tabs tab-pills">
					@can('price_list_create')
					<li><a href="javascript:void(0);" 
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
								<th class="table-th text-white">CODIGO</th>
								<th class="table-th text-white">%</th>
							</tr>
						</thead>
						<tbody>
							@foreach($list as $item)
							<tr>
								<td><h6>{{$item->id}}</h6></td>
								<td><h6>{{$item->name}}</h6></td>
								<td><h6>{{$item->slug}}</h6></td>
								<td><h6>{{$item->percent}}</h6></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					{{$list->links()}}
				</div>
			</div>
		</div>
		@include('livewire.payment-type.form')
	</div>
</div>
<script>
	document.addEventListener('DOMContentLoaded', function () {
		//events
		window.livewire.on('payment-added', Msg => {
			$('#theModal').modal('hide')
			noty(Msg)
		})

	})
</script>