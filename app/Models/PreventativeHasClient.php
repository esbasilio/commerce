<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\Preventist;

class PreventativeHasClient extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'preventist_id', 'client_id', 'shop_id'];

    public function client()
    {
        return $this->hasOne(User::class,'id','client_id');

    }

    public function preventist()
    {
        return $this->hasOne(User::class,'id','preventist_id');

    }

}
