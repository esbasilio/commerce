<!DOCTYPE html>
<html lang="es">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>Reporte de Ventas </title>
    <link href="{{ asset('css/custom_pdf.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/custom_page.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
    <!-- SECCIÓN ENCABEZADO DE PÁGINA -->
    <section class="header" style="top: -287px;">
        <table cellpadding="0" cellspacing="0" class="" width="100%">
            <tr>
                <td colspan="2" class="text-center">               
                    <span style="font-size: 25px; font-weight: bold"> Sistema LWPOS</span>
                </td>
            </tr>
            <tr>
                <td width="30%" style="vertical-align: top; padding-top: 10px; position: relative;">
                    <img src="{{ asset('assets/img/livewire_logo.png') }}" class="invoice-logo"/>
                </td>
                <td width="70%" class="text-left text-company" style="vertical-align: top; padding-top: 10px;">
                    @if($reportType == 0)
                    <span style="font-size: 16px"><strong>Reporte de Ventas del Día </strong></span>
                    @else
                    <span style="font-size: 16px"><strong>Reporte de Ventas por Fechas </strong></span>
                    @endif
                    <br/>
                    @if($reportType != 0)
                    <span style="font-size: 14px"> Fechas de Consulta: del {{$dateFrom}} al {{$dateTo}} </span>
                    @else
                    <span style="font-size: 14px"> Fecha de Consulta: {{\Carbon\Carbon::now()->format('d-M-Y') }}  </span>
                    @endif
                    <br/>
                    <span style="font-size: 14px"> Usuario: {{$user}} </span>                              

                </td>

            </tr>
        </table>

    </section>

    <!-- SECCIÓN TABLA DE VENTAS -->
    <section  style="margin-top: -110px">
        <table cellpadding="0"  cellspacing="0" class="table-items" width="100%">
            <thead>
                <tr>

                    <th width="10%"> FOLIO </th>     
                    <th width="12%"> IMPORTE </th>
                    <th width="10%"> ITEMS </th>       
                    <th width="12%"> ESTATUS </th>           
                    <th > USUARIO </th>
                    <th width="18%"> FECHA </th>
                </tr>
            </thead>
            <tbody>  
              @foreach ($data as $item)
              <tr>                 
                <td align="center">{{$item->id }}</td>     
                <td align="center"> ${{number_format($item->total,2) }} </td>        
                <td align="center">{{ $item->items }} </td>
                <td align="center"> {{$item->status}} </td>
                <td align="center"> {{$item->user}} </td>
                <td align="center"> {{$item->created_at}} </td>
            </tr>
            @endforeach  

            
        </tbody>
        <tfoot>

            <tr>
                <td class="text-center" >
                    <span >
                        <b>TOTALES</b>
                    </span>
                </td>
                <td colspan="1" class="text-center" >
                    <span ><strong>${{number_format($data->sum('total'),2)}}</strong></span>
                </td>
                <td class="text-center" >
                 {{$data->sum('items')}}                
             </span>
         </td>
         <td colspan="3"></td>
     </tr>
 </tfoot>
</table>




</section>

<!-- SECCIÓN PIE DE PÁGINA -->
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



</body>
</html>

