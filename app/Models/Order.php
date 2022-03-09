<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'status_id', 'person_id', 'shop_id', 'payment_type_id', 'total'];


    /**
     * Get order status.
     */
    public function status()
    {
        return $this->hasOne(OrderStatus::class, 'id', 'status_id');
    }

    /**
     * Get order payment_type.
     */
    public function payment_type()
    {
        return $this->hasOne(PaymentType::class, 'id', 'payment_type_id');
    }

    /**
     * Get order owner.
     */
    public function person()
    {
        //return $this->hasOne(Identification::class, 'id', 'identification_id');
    }

    /**
     * Get order comerce.
     */
    public function shop()
    {
        //return $this->hasOne(Identification::class, 'id', 'identification_id');
    }

    /**
     * Get the Order details.
     */
    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
}
