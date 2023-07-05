<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;
use DB;

class OrderDetailController extends Controller
{    

    public static function orderdetail($id){        
        $sql = "SELECT orderdetail.*,product.productName 
                FROM orderdetail
                    INNER JOIN product ON orderdetail.productID = product.productID
                WHERE orderid=$id";
          
        return DB::select($sql);        
    }
}