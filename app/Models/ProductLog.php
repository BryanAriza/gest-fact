<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductLog extends Model
{
    use HasFactory;
    protected $fillable = 
            ['product_name','id_product','id_category','price','stock','iva','date_carga','created_at','updated_at'];
}
