<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preventist extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name','last_name','references'];

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
