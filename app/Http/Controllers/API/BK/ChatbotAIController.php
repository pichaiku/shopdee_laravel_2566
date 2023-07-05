<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;


class ChatbotAIController extends Controller
{    
    public function chatbot()
    {                   
        //รับข้อความจากผู้ใช้
        $content = file_get_contents('php://input');
        $arrayJson = json_decode($content, true);            
        $message = $arrayJson['events'][0]['message']['text'];
        $userid = $arrayJson["events"][0]["source"]["userId"];        
        $timestamp = $arrayJson["events"][0]["timestamp"];   
        
        //กำหนด access token และ header สำหรับ return message ไปยัง users
        $accessToken = "/1+2TmrOmK1PmVtl8gAAS93e8V7+ikGOC9vDPccVyGgiWFlHrMLZ/5jqfDoRnAkBbINXquGo1zHqEWrPKKdC7bomOdOE9DyaDXSjHwNGEzeP10bMzEIf6KMXuWek48hH67LnkiIHATdXP5AdZsxpKQdB04t89/1O/w1cDnyilFU="; //line access token
        $arrayHeader = array();
        $arrayHeader[] = "Content-Type: application/json";
        $arrayHeader[] = "Authorization: Bearer {$accessToken}";
        
        if($message == "ทำนาย" || $message == "ภาพ" || $message == "ทำนายภาพ"){
            $path = "C:\\xampp\\htdocs\\shoppee\\app\\python\\test_object_detect.py";
            $filename = "C:\\Users\\HP\\data\\images\\test\\9338527.1.jpg"; 
                    
            ob_start();
            passthru("python $path $filename");         
            $data = preg_replace('~[\r\n]+~', '', ob_get_clean());             

            $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = $data;  
             
            ChatbotAIController::replyMsg($arrayHeader,$arrayPostData);  

        }else{
            $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = "พูดอีกครั้งได้ไหมคะ";  
             
            ChatbotAIController::replyMsg($arrayHeader,$arrayPostData);          
        }        
        
        exit;  
        
    }

    function replyMsg($arrayHeader,$arrayPostData){
        $strUrl = "https://api.line.me/v2/bot/message/reply";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$strUrl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);    
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arrayPostData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        //$result = curl_exec($ch);
        curl_exec($ch);
        curl_close ($ch);
        http_response_code(200);
    }  

}