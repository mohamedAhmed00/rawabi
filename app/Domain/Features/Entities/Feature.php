<?php
namespace App\Domain\Features\Entities;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = ['name','description','image'];
}
