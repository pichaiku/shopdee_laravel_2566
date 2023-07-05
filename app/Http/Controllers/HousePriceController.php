<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\HousePriceRequest;

class HousePriceController extends Controller
{
    public function index(){
        
        return view('houseprice.index');        
    }

    public function predict(HousePriceRequest $request){
        echo "cc";die();
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
        
        return redirect("/houseprice")->with("success","ราคาประเมินบ้าน คือ $price บาท/ตารางเมตร"); 
    }

    // public function train(){
    //     return view('houseprice.train');
    // }

    // public function build(){
    //     $path = "C:\\xampp\\htdocs\\shopdee\\app\\python\\train_mlp.py";

    //     ob_start();
    //     passthru("python $path");
    //     $output = preg_replace('~[\r\n]+~','', ob_get_clean());     

    //     echo "<script>alert('$output')</script>";

    // }

}