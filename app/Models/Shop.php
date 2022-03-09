<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'identification_id',
        'business_name',
        'address_id',
        'contact_id',
        'logo'
    ];
}