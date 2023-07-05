<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class BookController extends Controller
{   
    public function store(Request $request)
    {
        $bookName = $request->input('bookName');    
        echo $bookName."xx";die();    
        $amount = $request->get('amount');
        $price = $request->get('price');
        $sql = "INSERT INTO book (bookName, amount, price)VALUES('$bookName', '$amount', '$price')";
        DB::insert($sql);
        return response()->json(array('message'=>'success','status'=>'true'));
    }    

    public function update(Request $request,$id)
    {        
        $amount = $request->get('amount');
        $price = $request->get('price');
        $sql = "UPDATE book SET amount = $amount, price = $price WHERE bookID = $id";
        DB::update($sql);
        return response()->json(array('message'=>'success','status'=>'true'));
    }    
    
    public function show($id)
    {        
        $sql = "SELECT bookName, amount, price FROM book WHERE bookID = $id";
        return DB::select($sql);        
    }                
}


