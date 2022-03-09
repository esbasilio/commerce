<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductHasVariation extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'product_id', 'variation_name'];

    public function productVariationAttrs()
    {
        return $this->hasMany(ProductVariationAttribute::class, 'variation_id', 'id');
    }
}
