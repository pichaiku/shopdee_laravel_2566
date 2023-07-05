<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product2 extends Model
{
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'productID';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'productName',
                  'productDetail',
                  'price',
                  'quantity',
                  'imageFile',
                  'typeID'
              ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
    
    /**
     * Get the orderdetails for this model.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function orderdetails()
    {
        return $this->hasMany('App\Models\Orderdetail','productid','productid');
    }



}
