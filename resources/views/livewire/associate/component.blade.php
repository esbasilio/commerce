<div class="row sales layout-top-spacing">

	<div class="col-sm-12 ">
		<div class="widget widget-chart-one">
			<div class="widget-heading">
				<h4 class="card-title"><b>{{$componentName}}</b> </h4>	
			</div>
			<div class="widget-content">
				@can('associate_new')
				<form class="form-inline">
					<div class="col-sm-10 col-md-4">

						<div class="row justify-content-between">
							<div class="col-sm-12">
								<div class="input-group mb-4">
									<div class="input-group-prepend">
										<span class="input-group-text input-gp" >
											<i class="fas fa-search"></i>
										</span>
									</div>
									<input type="text"
									wire:model="search_preventists"
									class="form-control" placeholder="Buscar Preventista">
								</div>
							</div>
						</div>

					</div>
					<div class="col-sm-10 col-md-4">

						<div class="row justify-content-between">
							<div class="col-sm-12">
								<div class="input-group mb-4">
									<div class="input-group-prepend">
										<span class="input-group-text input-gp" >
											<i class="fas fa-search"></i>
										</span>
									</div>
									<input type="text"
									wire:model="search_clients"
									class="form-control" placeholder="Buscar Preventista">
								</div>
							</div>
						</div>

					</div>
					<!-- <div class="form-group mr-2">
						<button type="button" wire:click="Store()" class="btn btn-info">GUARDAR</button>
					</div> -->
				</form>
				@endcan
				<div class="row mt-3">
					<div class="col-sm-12">
						<div class="table-responsive">
							<table class="table table-bordered table-striped mt-1">
								<thead class="text-white backgroud-table-th">
									<tr>
										<th class="table-th text-left text-white">PREVENTISTA</th>
										<th class="table-th text-left text-white">CLIENTE</th>
									</tr>
								</thead>
								<tbody>
								<tr>
									<td class="align-top">
										<table class="table table-bordered table-striped mt-1">
											@foreach($preventists as $prev)
											<tr>
												<td>
													<h6>
													<input 
														type="radio"
														name="nvidia" 
														class="nvd" 
														wire:click="listClients({{$prev->id}})"
													>
													{{$prev->uname}}
													</h6>
												</td>
											</tr>
											@endforeach
										</table>
									</td>
									<td class="align-top">
										<table>
										@if($list!=null)
										@foreach($list as $row)
											<tr>
												<td>
													<h6>
													@if($preventist_selected_id == (int)$row->preventist_id)
														<button 
															class="btn btn-danger"
															wire:click="deleteRelation({{$row->client_id}})"
														>eliminar</button>
													@else
														<button 
															class="btn btn-success"
															wire:click="makeRelation({{$row->uid}})"
														>vincular</button>
													@endif
													</h6>
												</td>
												<td>
													<h6>
														{{$row->uname}}
													</h6>
												</td>
											</tr>
										@endforeach
										@endif
										</table>
									</td>
								</tr>
								</tbody>
							</table>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	document.addEventListener('DOMContentLoaded', function () {  

		window.livewire.on('relation-added', Msg => {
			noty(Msg)
		})
		window.livewire.on('relation-deleted', Msg => {
			noty(Msg)
		})
		window.livewire.on('unselect-radio', Msg => {
			$('input').filter(':radio').prop('checked',false)
		})
	})
</script>