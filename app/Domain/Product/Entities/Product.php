<?php
namespace App\Domain\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = ['name','slug','cutting','image','active','order'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function categories()
    {
        return $this->hasMany(ProductCategory::class ,'product_id');
    }

    /**
     * @param $value
     * @author Mohamed Ahmed
     * @return false|string[]
     */
    public function getCuttingAttribute($value)
    {
        return explode("," ,$value);
    }
}
