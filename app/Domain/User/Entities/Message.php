<?php
namespace App\Domain\User\Entities;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['name','phone','message'];
}
