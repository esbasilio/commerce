<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductChannel extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'channel_id', 'product_id'];
}
