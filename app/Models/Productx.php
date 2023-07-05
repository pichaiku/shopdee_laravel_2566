<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Product extends Model
{
    protected $table = 'product'; // Ignore automatically add "s" into table name
    public $incrementing = true; 
    public $timestamps = false; // Ignore automatically add create_at and update_at attribute into table
    protected $primaryKey = 'productID'; //Ignore automatically query with id as primary key


    protected $fillable = [
        'productID', 'productName', 'price', 'amount','imageFileName', 'productTypeID'
    ];

    public static function index($query="",$productTypeID="")
    {
        $sql="SELECT * FROM product 
                INNER JOIN product_type ON product_type.productTypeID=product.productTypeID
              WHERE 1 ";
        if($query!=""){
            $sql.="AND product.productName LIKE '%$query%' OR 
                       product_type.productTypeName LIKE '%$query%' ";
        }

        if($productTypeID!=""){
            if($productTypeID=="*"){ //ค้นหาประเภทอื่น ๆ นอกเหนือ Top 3
                $sql.="AND product.productTypeID in (1,2,3) ";
            }else{
                $sql.="AND product.productTypeID=$productTypeID ";
            }
        } 

        $sql.="ORDER BY product.productID ASC ";
         return DB::select($sql);
    }
 

    public static function view($id)
    {
        $sql="SELECT * FROM product 
            INNER JOIN product_type ON product_type.productTypeID=product.productTypeID 
            WHERE product.productID=$id";
        $data=DB::select($sql);
        if(count($data)>0)$data=$data[0];
        return $data;
    }    
}
