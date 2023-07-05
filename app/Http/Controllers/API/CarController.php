<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Log;

class CarController extends Controller
{   

    public function index(){

        $sql = "SELECT * FROM car ";
        $products=DB::select($sql);

        return response()->json($products);
        
    }

    public function show($id){

        $sql = "SELECT * FROM car WHERE carID=$id";
        $products=DB::select($sql)[0];

        return response()->json($products);
        
    } 

    public function rent(Request $request)
    {
        $rentDate = $request->get('rentDate');             
        $rentTime = $request->get('rentTime');
        $returnDate = $request->get('returnDate');                    
        $returnTime = $request->get('returnTime');
        $totalPrice = $request->get('totalPrice');            
        $custID = $request->get('custID');
        $carID = $request->get('carID');
                    
        $sql = "INSERT INTO `rent`(`rentDate`, `rentTime`, `returnDate`, `returnTime`, `totalPrice`, `custID`, `carID`) VALUES 
        ('$rentDate', '$rentTime', '$returnDate', '$returnTime', $totalPrice, $custID, $carID)";
        Log::info($sql);

        DB::insert($sql);
        return response()->json(array('message'=>'success','status'=>'true'));
    }       
}


