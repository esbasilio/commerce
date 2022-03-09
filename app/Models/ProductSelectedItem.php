<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSelectedItem extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'shop_id', 'product_id', 'person_id', 'product_price'];
}
