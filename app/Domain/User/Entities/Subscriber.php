<?php
namespace App\Domain\User\Entities;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable = ['email'];

}
