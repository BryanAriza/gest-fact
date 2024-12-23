<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = 
            ['first_name','last_name','id_type','document','phone','email'];


    public function salesHeaders()
    {
        return $this->hasMany(SalesHeader::class, 'id_customer');
    }


    public function typeDocument()
    {
        return $this->belongsTo(TypeDocument::class, 'id_type');
    }

}