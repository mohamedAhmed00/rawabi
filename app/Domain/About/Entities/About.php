<?php
namespace App\Domain\About\Entities;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = ['title','description','image'];
}
