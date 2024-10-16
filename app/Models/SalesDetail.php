<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesDetail extends Model
{
    use HasFactory;
    protected $fillable = 
            ['id_sales_header','id_product','product_name','cant_product','unit_price','created_at','updated_at'];

}
