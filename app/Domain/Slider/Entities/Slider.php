<?php
namespace App\Domain\Slider\Entities;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['name','image','video','order','status'];
}
