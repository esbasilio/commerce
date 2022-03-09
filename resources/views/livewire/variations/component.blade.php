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
								<th class="table-th text-white">NOMBRE</th>
								<th class="table-th text-white">ATRIBUTOS</th>
							</tr>
						</thead>
						<tbody>
							@foreach($variations as $var)
							<tr>
								<td>
								<button 
										class="btn btn-danger delete-attribute-btn"
										wire:click="removeVariation({{$var->id}})">x</button>
									<!--<h6>{{$var->id}}</h6>-->
								</td>
								<td><h6>{{$var->name}}</h6></td>
								<td>
									@foreach(json_decode($var->options) as $attr)
									<h6 class="btn">{{$attr}}<button 
										class="btn btn-danger delete-attribute-btn"
										wire:click="removeAttr({{$var->id}}, '{{$attr}}')">x</button>
									</h6>
									@endforeach
									<input 
										id="add{{$var->id}}" 
										type="text" 
										class="btn" 
										wire:blur="addAttr({{$var->id}}, $('#add{{$var->id}}').val())">
								</td>
							</tr>
							@endforeach
							<tr>
								<td>Nueva Variation</td>
								<td>
									<input 
											id="add-variation" 
											type="text" 
											class="btn" 
											wire:blur="addVariation($('#add-variation').val())">
								</td>
								<td>
								</td>
							</tr>
						</tbody>
					</table>
					{{$variations->links()}}
				</div>
			</div>
		</div>
	</div>
</div>
