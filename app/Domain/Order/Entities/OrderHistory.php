<?php
namespace App\Domain\Order\Entities;

use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    protected $table = 'order_histories';

    protected $fillable = ['checkout_id','status','comment'];
}
