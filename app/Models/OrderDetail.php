<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'order_id', 'product_id', 'product_price', 'quantity'];

    /**
     * Get franchise address.
     */
    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
