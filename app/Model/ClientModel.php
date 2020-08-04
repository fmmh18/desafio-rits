<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ClientModel extends Model
{
    protected $table = "client";
    protected  $fillable = ['id','name','email', 'phone','address'];
}
