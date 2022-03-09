<div wire:ignore.self class="modal fade" id="modal-price-list" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<h5 class="modal-title text-white" >
					<b>{{'Lista de precios'}}</b>
					{{--type:{{$entity_type}} list:{{$current_list}} price:{{$current_price}} {{$entity_type}}_id:{{$variation_id}} --}}
				</h5>
				<h6 class="text-center text-warning" wire:loading>POR FAVOR ESPERE</h6>			
			</div>

			<div class="modal-body">
				<table>
					<thead class="">
						<tr>
							<th class="">Lista</th>
							<th class="">Precio</th>
						</tr>
					</thead>
					@if(!empty($product_prices))
						@foreach($product_prices as $pp)
						<tr>
							<td>
								{{$pp['list_name']}}
							</td>
							<td>
							{{$pp['price']}}
							</td>
						</tr>
						@endforeach
					@endif
					<tr>
						<td>
							<select class="form-control" wire:model="current_list">
							<option value="0">Elegir</option>
							@foreach($price_lists as $pl)
								<option value="{{$pl->id}}">{{$pl->name}}</option>
							@endforeach
							</select>
						</td>
						<td>
							<input type="number" class="form-control" wire:model="current_price">
						</td>
					</tr>
				</table>
			</div>
			{{-- wire:click.prevent="resetUI()" --}}
			<div class="modal-footer">
				<button type="button" class="btn btn-dark close-btn text-info" 
						wire:click:prevent="resetPriceValues()"
						data-dismiss="modal">
						CERRAR
				</button>
				<button type="button" wire:loading.remove wire:click.prevent="savePrice()" 
						class="btn btn-success close-modal">
						GUARDAR
				</button>
			</div>
		</div>
	</div>
</div>