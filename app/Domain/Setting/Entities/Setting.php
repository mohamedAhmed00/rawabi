<?php
namespace App\Domain\Setting\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Setting extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = ['key' , 'value'];

    /**
     * @param $value
     * @return string
     */
    public function setKeyAttribute($value){
        $this->attributes['key'] = Str::snake($value);
    }
}
