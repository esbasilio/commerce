<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'price', 'product_type', 'price_list_id', 'product_id'];

    public function priceList()
    {
        return $this->hasOne(ProductPriceList::class, 'id', 'price_list_id');
    }
}
