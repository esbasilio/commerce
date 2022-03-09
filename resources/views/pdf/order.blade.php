<!DOCTYPE html>
<html lang="es">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Reporte de Pedido </title>
    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <style>
        table tr th{color:white; background-color: #ff0000; padding: 12px;}
        table tr td{padding-left: 12px; padding-right: 12px;}
        img{width: 69px; height: 69px; position: relative; top: -60px!important}
    </style>

</head>
<body>
    <section class="header">
        <table class="table table-hover table-xl mb-0 table-de mt-1">
            <tr>
                <td>
                    <img src="https://image.shutterstock.com/image-vector/click-go-website-internet-line-600w-516477817.jpg" class="invoice-logo"/>
                </td>
                <td style="text-align: right;">
                    <b>REPORTE DE PEDIDO</b>
                </td>
                <!--
                <td width="70%" class="text-left text-company" style="vertical-align: top; padding-top: 10px;">
                    <span style="font-size: 14px"> Usuario: {{$user->name}} </span>
                </td>-->
            </tr>
        </table>
    </section>
    <!-- SECCIÓN TABLA DE VENTAS -->
    <section>
        <table class="table table-hover table-xl mb-0 table-de mt-1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>PRODUCTO</th>
                    <th class="text-center">CANTIDAD</th>
                    <th style="text-align: right;">PRECIO</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($order_details))
                    @foreach($order_details as $detail)
                        <tr>
                            <td>{{$detail->id}}</td>
                            <td>{{$detail->product()->first()->name}}</td>
                            <td class="text-center">{{$detail->quantity}}</td>
                            <td style="text-align: right;">{{$detail->product_price}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td><b>TOTAL</b></td>
                        <td></td>
                        <td></td>
                        <td style="text-align: right;"><strong>${{number_format($order->total, 2)}}</strong></td>
                    </tr>
                @endif
            </tbody>
        </table>
</section>
<!-- SECCIÓN PIE DE PÁGINA
<section class="footer">
    <table cellpadding="0" cellspacing="0" class="" width="100%">
        <tr>
            <td width="20%">
                <span> Sistema LWPOS  v 1 </span>
            </td>
            <td width="60%" class="text-center">
                luisfax.com
            </td>
            <td width="20%" class="text-right">
                pagina <span class="pagenum"></span>
            </td>
        </tr>
    </table>
</section>
-->
</body>
</html>