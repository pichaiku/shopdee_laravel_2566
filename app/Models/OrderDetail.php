<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class OrderDetail extends Model
{
    //protected $primaryKey = null;
    //protected $primaryKey = ['user_id', 'stock_id']
    protected $table = 'order_detail'; // Ignore automatically add "s" into table name
    public $incrementing = true; // Ignore incremental primary key
    public $timestamps = false; // Ignore automatically add create_at and update_at attribute into table
    protected $primaryKey = 'orderID,productID'; //Ignore automatically query with id as primary key

    protected $fillable = [
        'orderID', 'productID', 'quantity', 'price'
    ];

    public static function index($id)
    {
       $sql="SELECT order_detail.*,product.productName,product_type.productTypeName  
             FROM order_detail 
                INNER JOIN product ON product.productID=order_detail.productID 
                INNER JOIN product_type ON product_type.productTypeID=product.productTypeID  
             WHERE order_detail.orderID=$id";
       return DB::select($sql);
    }

   public static function view($orderID,$productID)
   {
      $sql="SELECT order_detail.*,product.productName,product_type.productTypeName  
            FROM order_detail 
               INNER JOIN product ON product.productID=order_detail.productID 
               INNER JOIN product_type ON product_type.productTypeID=product.productTypeID  
            WHERE order_detail.orderID=$orderID AND order_detail.productID=$productID";
      $data=DB::select($sql);
      if(count($data)>0)$data=$data[0];
      return $data;
   }

  
}
