<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Franchise extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'business_name',
        'branch_number',
        'shop_id'
    ];

    /**
     * Get franchise address.
     */
    public function address()
    {
        return $this->hasOne(Address::class, 'id', 'address_id');
    }

    /**
     * Get franchise contact.
     */
    public function contact()
    {
        return $this->hasOne(Contact::class, 'id', 'contact_id');
    }

    /**
     * Get franchise identificacion.
     */
    public function identification()
    {
        return $this->hasOne(Identification::class, 'id', 'identification_id');
    }
}
