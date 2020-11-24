<?php
namespace App\Domain\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = ['product_id','name','price'];

}
