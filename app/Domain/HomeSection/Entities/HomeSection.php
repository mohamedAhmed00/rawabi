<?php
namespace App\Domain\HomeSection\Entities;

use Illuminate\Database\Eloquent\Model;

class HomeSection extends Model
{
    protected $fillable = ['title','description','image'];
}
