<div wire:ignore.self class="modal fade" id="theModal" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<h5 class="modal-title text-white" >
					<b>{{$componentName}}</b> | 
					@if(isset($componentDescription))
						{{$componentDescription}}
					@else
						{{ $selected_id > 0 ? 'EDITAR' : 'CREAR' }}
					@endif

				</h5>
				<h6 class="text-center text-warning" wire:loading>POR FAVOR ESPERE</h6>			
			</div>

			<div class="modal-body">
				