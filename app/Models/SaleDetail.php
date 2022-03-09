<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sale;
use App\Models\seccionalmacen;

class SaleDetail extends Model
{
    use HasFactory;

    protected $fillable = ['price','quantity','product_id','sale_id','seccionalmacen_id','comercio_id'];

  
}
