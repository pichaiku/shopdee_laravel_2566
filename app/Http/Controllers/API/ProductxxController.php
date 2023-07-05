<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{    

    public function index($id="")
    {   
        if(empty($id)){
            $sql="SELECT * FROM product ORDER BY productID ASC";
            $product=DB::select($sql);
            
        }else{
            $sql="SELECT * FROM product WHERE productID=$id ORDER BY productID ASC";            
            $product=DB::select($sql)[0];
        }          

        return response()->json($product);
    }

}