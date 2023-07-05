<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class OrderdetailController extends Controller
{    

    public function orderdetail($id){        
        $sql = "SELECT orderdetail.*,product.productName 
                FROM orderdetail
                    INNER JOIN product ON orderdetail.productID = product.productID
                WHERE orderid=$id";
          
        return DB::select($sql);        
    }
}