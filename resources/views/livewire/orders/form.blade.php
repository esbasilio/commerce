@include('common.modalHead')
<label>Total: {{$total}}</label>

<table class="table table-bordered table-striped">
<thead class="text-white backgroud-table-th">
  <tr>
    <th class="table-th text-white">ID</th>
    <th class="table-th text-white">PRODUCTO</th>
    <th class="table-th text-white text-center">CANTIDAD</th>
    <th class="table-th text-white text-right">PRECIO</th>
  </tr>
</thead>
<tbody>
@if(!empty($order_details))
  @foreach($order_details as $detail)
  <tr>
    <td>{{$detail->id}}</td>
    <td>{{$detail->product()->first()->name}}</td>
    <td class="text-center">{{$detail->quantity}}</td>
    <td class="text-right">{{$detail->product_price}}</td>
  </tr>
  @endforeach
@endif
</tbody>
</table>
@include('common.modalFooter')
