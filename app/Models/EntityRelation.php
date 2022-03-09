<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityRelation extends Model
{
    use HasFactory;
    protected $fillable = [
        'role_slug',
        'entity',
        'sale_channel'
    ];
}