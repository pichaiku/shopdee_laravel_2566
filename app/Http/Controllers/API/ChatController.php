<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{       
    
    public function list($id){

        $sql = "SELECT chat.empID, message, 
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

        $sql = "SELECT  message, 
                CASE
                    WHEN CAST(CURRENT_TIMESTAMP AS DATE) = SUBSTRING(createDate,1,10) THEN CONCAT(DATE_FORMAT(createDate,'%H.%i'),' น.')
                    ELSE DATE_FORMAT(createDate,'%d/%m') 
                END AS createDate, sender,orderID,imageFile
                FROM chat 
                INNER JOIN employee ON chat.empID = employee.empID                            
                WHERE chat.custID = $custID AND chat.empID = $empID";
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

        if($orderID==""){
//            echo "xx";die();
            $orderID = 'NULL';
        }
                    
        $sql = "INSERT INTO chat(message, createDate, custID, empID, orderID, sender) VALUES 
                ('$message', '$createDate', $custID, $empID, $orderID, '$sender')";        

        DB::insert($sql);
        return response()->json(array('message'=>'success','status'=>'true'));
    }       
}


