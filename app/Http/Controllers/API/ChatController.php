<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{       
    
    public function list($id){

        $sql = "SELECT chat.empID, message, orderID,  
                CASE
                    WHEN CAST(CURRENT_TIMESTAMP AS DATE) = SUBSTRING(createDate,1,10) THEN CONCAT(DATE_FORMAT(createDate,'%H.%i'),' น.')
                    ELSE DATE_FORMAT(createDate,'%d/%m') 
                END AS createDate, 
                        imageFile, CONCAT(firstName,' ', lastName) AS employee
                FROM chat 
                INNER JOIN employee ON chat.empID = employee.empID
                WHERE msgID IN 
                    (SELECT max(msgID) 
                    FROM `chat` 
                    WHERE `custID`= $id 
                    GROUP BY empID)                 
                ORDER BY createDate DESC";
        $chat=DB::select($sql);

        return response()->json($chat);
        
    } 

    public function show(Request $request){
        $custID = $request->get('custID');             
        $empID = $request->get('empID');
        $orderID = $request->get('orderID');        

        if($empID == "-1"){
            $empID = $this->getEmpID();
        }
        
        $sql = "SELECT  message, 
                CASE
                    WHEN CAST(CURRENT_TIMESTAMP AS DATE) = SUBSTRING(createDate,1,10) THEN CONCAT(DATE_FORMAT(createDate,'%H.%i'),' น.')
                    ELSE DATE_FORMAT(createDate,'%d/%m') 
                END AS createDate, sender,orderID,imageFile
                FROM chat 
                    INNER JOIN employee ON chat.empID = employee.empID                            
                    WHERE chat.custID = $custID AND chat.empID = $empID AND chat.orderID = $orderID 
                ORDER BY msgID DESC";
        //Log::info($sql);
        $chat = DB::select($sql);

        return response()->json($chat);
        
    }


    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Bangkok');
        $message = $request->get('message');             
        $createDate = date("Y-m-d H:i:s");
        $custID = $request->get('custID');                    
        $empID = $request->get('empID');
        $orderID = $request->get('orderID');                    
        $sender = "c";   

        if($empID == "-1"){
            $empID = $this->getEmpID();
        }
                    
        $sql = "INSERT INTO chat(message, createDate, custID, empID, orderID, sender) VALUES 
                ('$message', '$createDate', $custID, $empID, $orderID, '$sender')";        
        
        DB::insert($sql);
        return response()->json(array('message'=>'success','status'=>'true'));
    }         

    private function getEmpID(){
        // $sql = "SELECT chat.empID, COUNT(orderID) AS orderCount 
        // FROM chat INNER JOIN employee ON chat.empID = employee.empID 
        // WHERE custID = $CustID AND orderID = $orderID 
        // GROUP BY chat.empID 
        // ORDER BY orderCount DESC 
        // LIMIT 1;";
        $sql = "SELECT employee.empID, COUNT(orderID) AS orderCount 
        FROM employee LEFT JOIN chat ON employee.empID = chat.empID         
        GROUP BY employee.empID 
        ORDER BY orderCount ASC 
        LIMIT 1;";

        $result=DB::select($sql);

        $empID = -1;
        if(count($result) > 0){
            $empID = $result[0]->empID;
        }else{
            $sql = "SELECT empID 
                    FROM employee 
                    ORDER BY RAND() 
                    LIMIT 1";
            $result=DB::select($sql);
            $empID = $result[0]->empID;
        }
        return $empID;
    }
}


