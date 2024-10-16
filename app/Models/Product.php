<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = 
            ['product_name','description','id_category','price','stock','iva'];

    public function sales()
    {
        return $this->hasMany(SalesDetail::class, 'id_product');
    }
}
