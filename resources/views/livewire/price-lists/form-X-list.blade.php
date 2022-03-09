<div wire:ignore.self class="modal fade" id="modal-list" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document" style="border:solid 5px magenta; width:250px!important">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<h5 class="modal-title text-white" >
					<b>CANTIDAD</b>
				</h5>
				<h6 class="text-center text-warning" wire:loading>POR FAVOR ESPERE</h6>			
			</div>
		<div class="modal-body">
        	<input type="text" wire:model="current_quantity">
      	</div>
    <div class="modal-footer">
        <button wire:click="updateQuantity()" type="button" 
				class="btn btn-dark close-btn text-info" 
				data-dismiss="modal">ACEPTAR</button>
    </div>
</div>