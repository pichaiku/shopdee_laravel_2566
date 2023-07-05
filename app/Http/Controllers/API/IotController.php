<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class IotController extends Controller
{ 

    public function write(Request $request)
    {   
        $slot_id = $request->post("slot_id");     
        $parking_status = $request->post("parking_status");                        
        $timestamp = time();
        $sql = "UPDATE car_parking SET parking_status = $parking_status, timestamp = $timestamp 
                WHERE slot_id = $slot_id";                       
        DB::update($sql);

        return response()->json(
            array('message' =>'success','status' => 'true')
        ); 

    }

    public function read(){        
        $sql = "SELECT * 
        FROM `car_parking`  
        ORDER BY slot_id";
          
        return DB::select($sql);        
    }

    public function control(){        
        $sql = "SELECT control FROM car_remote";          
        return DB::select($sql)[0]->control;        
    }

}