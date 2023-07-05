<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{   

    public function index(){

        $sql = "SELECT * FROM product ";
        $products=DB::select($sql);

        return response()->json($products);
        
    }

    public function show($id){

        $sql = "SELECT * FROM product WHERE productID=$id";
        $products=DB::select($sql)[0];

        return response()->json($products);
        
    }
}