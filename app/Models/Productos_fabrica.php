<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos_fabrica extends Model
{
  protected $fillable = ['name','barcode','cost','price','stock','alerts','category_id','image','comercio_id','habilitado','cantidad'];

    use HasFactory;

    public function category()
    {
      return $this->belongsTo(Categorias_fabrica::class);
    }
}
