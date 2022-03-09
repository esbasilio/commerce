@include('common.modalHead')
<div class="row">
    <div class="col-sm-12 col-md-8">
      <div class="form-group">
        <label>Nombre</label>
          <input type="text" wire:model.lazy="name" class="form-control" placeholder="ej: efectivo">
        @error('name') <span class="text-danger er">{{ $message }}</span> @enderror
      </div>

      <div class="form-group">
        <label>Codigo</label>
          <input type="text" wire:model.lazy="slug" class="form-control" placeholder="">
        @error('slug') <span class="text-danger er">{{ $message }}</span> @enderror
      </div>

      <div class="form-group">
        <label>Porcentaje</label>
          <input type="number" wire:model.lazy="percent" class="form-control" placeholder="ej: 15">
        @error('percent') <span class="text-danger er">{{ $message }}</span> @enderror
      </div>

    </div>
</div>
@include('common.modalFooter')
