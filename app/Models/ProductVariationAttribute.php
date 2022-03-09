<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariationAttribute extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'variation_id', 'attribute_id', 'attribute_value'];

    public function attribute()
    {
        return $this->hasOne(Variation::class, 'id', 'attribute_id');
    }
}
