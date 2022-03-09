  <ul class="table-controls">                                                          
  	<li>
  		<a href="javascript:void(0);" wire:click="edit({{$r->id}})" data-toggle="tooltip" data-placement="top" title="Edit">>
  		</a>
  	</li>
  	<li>
  		<a href="javascript:void(0);" onclick="Confirm('{{$r->id}}')" data-toggle="tooltip" data-placement="top" title="Delete">
  		</a>
  	</li>
  </ul>
