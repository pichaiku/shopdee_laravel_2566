<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ChatbotDBController extends Controller
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
                     

        #ตัวอย่าง Message Type "Text" และ "Sticker"
        #https://developers.line.biz/en/docs/messaging-api/sticker-list/        
        if($message == "สวัสดี" || $message == "สวัสดีค่ะ" || $message == "สวัสดีครับ"){
            $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = "สวัสดีค่ะ ฟู้ดดี ยินดีต้อนรับ";

            $arrayPostData['messages'][1]['type'] = "sticker";
            $arrayPostData['messages'][1]['packageId'] = "6359";
            $arrayPostData['messages'][1]['stickerId'] = "11069861";
            
            ChatbotDBController::replyMsg($arrayHeader,$arrayPostData);
        }
        else if($message == "เมนูแนะนำ" || $message == "แนะนำ" || $message == "เมนูเด็ด"){
            $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = "เมนูแนะนำสำหรับวันนี้ค่ะ";

            $arrayPostData['messages'][1]['type'] = "text";
            $arrayPostData['messages'][1]['text'] = "กระเพาหมูสับไข่ดาวราดข้าว ราคา 70 บาท";

            $image_url = "https://img.wongnai.com/p/1968x0/2018/04/17/06993eef2aa940e49c57c1c564c53376.jpg";
            $arrayPostData['messages'][2]['type'] = "image";
            $arrayPostData['messages'][2]['previewImageUrl'] = $image_url; //show this image in chat.
            $arrayPostData['messages'][2]['originalContentUrl'] = $image_url;//show this image when it is tapped.
            
            ChatbotDBController::replyMsg($arrayHeader,$arrayPostData);            
        }
        else if($message == "ที่อยู่" || $message == "ติดต่อ" || $message == "เบอร์ติดต่อ"){
            $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = "เบอร์โทร 0897366728";

            $arrayPostData['messages'][1]['type'] = "location";
            $arrayPostData['messages'][1]['title'] = "ร้านฟู้ดดี";
            $arrayPostData['messages'][1]['address'] =   "13.778365013248951, 100.55670575421117";
            $arrayPostData['messages'][1]['latitude'] = "13.778365013248951";
            $arrayPostData['messages'][1]['longitude'] = "100.55670575421117";
            
            ChatbotDBController::replyMsg($arrayHeader,$arrayPostData);            
        }
        else if($message == "สั่งอาหาร" || $message == "ขอสั่งอาหาร"){
            $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = "รับอะไรดีคะ";
            
            ChatbotDBController::replyMsg($arrayHeader,$arrayPostData);
        }
        else if($message == "ผัดซีอิ๊ว"){
            $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = "รับอะไรอีกไหมคะ";

            //add log
            $sql = "INSERT INTO chatlog(userid,message,timestamp) 
                    VALUES ('$userid','$message','$timestamp')";
            DB::insert($sql);           

            ChatbotDBController::replyMsg($arrayHeader,$arrayPostData);
        }
        else if($message == "กระเพาหมูสับไข่ดาวราดข้าว"){
            $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = "รับอะไรอีกไหมคะ";

            //add log
            $sql = "INSERT INTO chatlog(userid,message,timestamp) 
                    VALUES ('$userid','$message','$timestamp')";
            DB::insert($sql);  

            ChatbotDBController::replyMsg($arrayHeader,$arrayPostData);
        }        
        else if($message == "ข้าวไข่เจียวกุ้งสับ"){
            $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = "รับอะไรอีกไหมคะ";

            //add log
            $sql = "INSERT INTO chatlog(userid,message,timestamp) 
                    VALUES ('$userid','$message','$timestamp')";
            DB::insert($sql);  

            ChatbotDBController::replyMsg($arrayHeader,$arrayPostData);
        }  
        else if($message == "ไม่ค่ะ" || $message == "ไม่ครับ" || $message == "ไม่"){
            $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = "ฟู้ดดี ยินดีที่ได้ให้บริการค่ะ";            

            $arrayPostData['messages'][1]['type'] = "sticker";
            $arrayPostData['messages'][1]['packageId'] = "6359";
            $arrayPostData['messages'][1]['stickerId'] = "11069856";

            ChatbotDBController::replyMsg($arrayHeader,$arrayPostData);
        }else{
            $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = "พูดอีกครั้งได้ไหมคะ";  
             
            ChatbotDBController::replyMsg($arrayHeader,$arrayPostData);          
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