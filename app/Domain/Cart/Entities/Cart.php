<?php
namespace App\Domain\Cart\Entities;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';

    protected $fillable = ['key','user_id','content'];
}
