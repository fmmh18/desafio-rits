<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected  $table = "product";
    protected  $fillable = ['name','price'];
}
