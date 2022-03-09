<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_ventas_fabricas extends Model
{
    use HasFactory;

    protected $fillable = ['precio','cantidad','costo','comision','descuento','producto_id','ventas_id'];
}
