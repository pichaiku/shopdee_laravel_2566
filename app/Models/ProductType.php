<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;

    protected $table = "producttype";
    protected $primaryKey = "typeID";
    public $timestamps = false;

    // protected $fillable = [];
  
}
