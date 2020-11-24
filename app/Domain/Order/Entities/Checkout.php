<?php
namespace App\Domain\Order\Entities;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{

    protected $fillable = ['name','city','phone', 'email' ,'address','receive','payment','price','tax','location'];

    /**
     * @author Mohamed Ahmed
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders(){
        return $this->hasMany(Order::class ,'checkout_id');
    }

    /**
     * @author Mohamed Ahmed
     */
    public function histories(){
        return $this->hasMany(OrderHistory::class);
    }
}
