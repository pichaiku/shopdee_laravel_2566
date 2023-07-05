<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\HousePriceRequest;

class HousePriceController extends Controller
{    
    public function predict(Request $request){
        $python_path = "C:\\xampp\\htdocs\\shopdee\\app\\python\\house_price_predict.py";        
        $model_path = "C:\\xampp\\htdocs\\shopdee\\app\\python\\house_price_model.pkl";
        $age = $request->get('age');
        $distance = $request->get('distance');
        $minimart = $request->get('minimart');
        //echo "$path - $age - $distance - $minimart";die();
        ob_start();
        passthru("python $python_path $model_path $age $distance $minimart");
        $output = preg_replace('~[\r\n]+~','', ob_get_clean());       
        $price = number_format($output * 1000,2);
        
        return response()->json(
            array('price' => $price,'message' => 'success','status' => 'true')
        );    
    }

}