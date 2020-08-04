<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    protected  $table = "order";
    protected  $fillable = ['client_id','product_id','request_status'];
}
