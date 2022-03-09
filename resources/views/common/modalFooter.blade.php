</div>
    <div class="modal-footer">
        <button type="button" wire:click.prevent="resetUI()" class="btn btn-dark close-btn text-info" data-dismiss="modal">CERRAR</button>
        @if($selected_id == 0)
            <button type="button" wire:loading.remove wire:click.prevent="Store()" class="btn btn-success close-modal">GUARDAR</button>
        @elseif($selected_id >= 1)
            <button type="button" wire:loading.remove wire:click.prevent="Update()" class="btn btn-success close-modal">ACTUALIZAR</button>
        @endif
    </div>
</div>