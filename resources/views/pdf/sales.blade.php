<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Reporte de Ventas</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
         padding: 0px;
         border: 0px;
         cells
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
        color:white;
    }

    .gray {
        background-color: #3B3F5C
    }
</style>

</head>
<body>

  <table width="100%">
    <tr>
        <td valign="top">
        	<img src="{{ public_path('assets/img/livewire_logo.png') }}" alt="" width="150"/>
        </td>
        <td align="right">
            <h3>Sistema LWPOS</h3>
            <pre>
               == Reporte de Ventas ==
                Fecha de consulta:
                {{\Carbon\Carbon::now()}}
                phone
                fax
            </pre>
        </td>
    </tr>

  </table>

  <table width="100%">
    <tr>
        <td><strong>From:</strong> Linblum - Barrio teatral</td>
        <td><strong>To:</strong> Linblum - Barrio Comercial</td>
    </tr>

  </table>

  <br/>

  <table width="100%">
    <thead style="background-color: #3B3F5C;">
      <tr>
        <th>FOLIO</th>
        <th>TOTAL</th>
        <th>ITEMS</th>
        <th>ESTATUS</th>
        <th>USUARIO</th>
        <th>FECHA</th>
      </tr>
    </thead>
    <tbody>
    	@foreach($data as $d)
      <tr>
        <th scope="row">{{$d->id}}</th>
        <td align="center">${{number_format($d->total,2)}}</td>
        <td align="center">{{$d->items}}</td>
        <td align="center">{{$d->status}}</td>
        <td align="center">{{$d->user}}</td>
        <td align="center">{{$d->created_at}}</td>
      </tr>
      @endforeach
    </tbody>

    <tfoot>
        <tr>
            <td colspan="3"></td>
            <td align="right">Subtotal $</td>
            <td align="right">1635.00</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td align="right">Tax $</td>
            <td align="right">294.3</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td align="right">Total $</td>
            <td align="right" class="gray">$ 1929.3</td>
        </tr>
    </tfoot>
  </table>

</body>
</html>