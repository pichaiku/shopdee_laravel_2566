<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

use LINE\LINEBot\Event\MessageEvent\TextMessage;
use LINE\LINEBot\MessageBuilder\MultiMessageBuilder;
use LINE\LINEBot\MessageBuilder\LocationMessageBuilder;
use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;
use LINE\LINEBot\MessageBuilder\StickerMessageBuilder;


use Illuminate\Support\Facades\Log;

class LineBotController extends Controller
{    

    public function imageChatbot(Request $request)
    {
        $access_token = "nMG7V+hlPWK+9iZAu+fp6ITOZugvpV6D2mxFqtpbd3FDHlW4x25pTo+6ydMOFrGEeQRNLLt2aXQNykt2WLHxOv7RZiLsCuiVzK3UNEh08JmGzHBjcntwSRqt/6EwQRVKcaXA2zwNT6tazsCmQ2ReFgdB04t89/1O/w1cDnyilFU=";
        $channel_secret = "c3cc836abbc74e85377d551f6b8cf3d2";

        $httpClient = new CurlHTTPClient($access_token);
        $bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));
         
        // คำสั่งรอรับการส่งค่ามาของ LINE Messaging API
        $content = file_get_contents('php://input');
        
        // แปลงข้อความรูปแบบ JSON  ให้อยู่ในโครงสร้างตัวแปร array
        $events = json_decode($content, true);


        if(!is_null($events)){
            Log::info("x1");
            // ถ้ามีค่า สร้างตัวแปรเก็บ replyToken ไว้ใช้งาน
            $replyToken = $events['events'][0]['replyToken'];
            $userID = $events['events'][0]['source']['userId'];
            $sourceType = $events['events'][0]['source']['type'];
            $is_postback = NULL;
            $is_message = NULL;
            if(isset($events['events'][0]) && array_key_exists('message',$events['events'][0])){
                $is_message = true;
                $typeMessage = $events['events'][0]['message']['type'];
                //$userMessage = $events['events'][0]['message']['text'];     
                $idMessage = $events['events'][0]['message']['id']; 
                Log::info("x2");
            }
            if(isset($events['events'][0]) && array_key_exists('postback',$events['events'][0])){
                $is_postback = true;
                $dataPostback = NULL;
                parse_str($events['events'][0]['postback']['data'],$dataPostback);;
                $paramPostback = NULL;
                if(array_key_exists('params',$events['events'][0]['postback'])){
                    if(array_key_exists('date',$events['events'][0]['postback']['params'])){
                        $paramPostback = $events['events'][0]['postback']['params']['date'];
                    }
                    if(array_key_exists('time',$events['events'][0]['postback']['params'])){
                        $paramPostback = $events['events'][0]['postback']['params']['time'];
                    }
                    if(array_key_exists('datetime',$events['events'][0]['postback']['params'])){
                        $paramPostback = $events['events'][0]['postback']['params']['datetime'];
                    }                       
                }
            }   
            Log::info("x3");
            if(!is_null($is_postback)){
                $textReplyMessage = "ข้อความจาก Postback Event Data = ";
                if(is_array($dataPostback)){
                    $textReplyMessage.= json_encode($dataPostback);
                }
                if(!is_null($paramPostback)){
                    $textReplyMessage.= " \r\nParams = ".$paramPostback;
                }
                $replyData = new TextMessageBuilder($textReplyMessage);     
            }
            if(!is_null($is_message)){
                switch ($typeMessage){
                    case 'text':
                        $userMessage = strtolower($userMessage); // แปลงเป็นตัวเล็ก สำหรับทดสอบ
                        switch ($userMessage) {
                            case "p":
                                // เรียกดูข้อมูลโพรไฟล์ของ Line user โดยส่งค่า userID ของผู้ใช้ LINE ไปดึงข้อมูล
                                $response = $bot->getProfile($userID);
                                if ($response->isSucceeded()) {
                                    // ดึงค่ามาแบบเป็น JSON String โดยใช้คำสั่ง getRawBody() กรณีเป้นข้อความ text
                                    $textReplyMessage = $response->getRawBody(); // return string            
                                    $replyData = new TextMessageBuilder($textReplyMessage);         
                                    break;              
                                }
                                // กรณีไม่สามารถดึงข้อมูลได้ ให้แสดงสถานะ และข้อมูลแจ้ง ถ้าไม่ต้องการแจ้งก็ปิดส่วนนี้ไปก็ได้
                                $failMessage = json_encode($response->getHTTPStatus() . ' ' . $response->getRawBody());
                                $replyData = new TextMessageBuilder($failMessage);
                                break;              
                            case "สวัสดี":
                                // เรียกดูข้อมูลโพรไฟล์ของ Line user โดยส่งค่า userID ของผู้ใช้ LINE ไปดึงข้อมูล
                                $response = $bot->getProfile($userID);
                                if ($response->isSucceeded()) {
                                    // ดึงค่าโดยแปลจาก JSON String .ให้อยู่ใรูปแบบโครงสร้าง ตัวแปร array 
                                    $userData = $response->getJSONDecodedBody(); // return array     
                                    // $userData['userId']
                                    // $userData['displayName']
                                    // $userData['pictureUrl']
                                    // $userData['statusMessage']
                                    $textReplyMessage = 'สวัสดีครับ คุณ '.$userData['displayName'];             
                                    $replyData = new TextMessageBuilder($textReplyMessage);         
                                    break;              
                                }
                                // กรณีไม่สามารถดึงข้อมูลได้ ให้แสดงสถานะ และข้อมูลแจ้ง ถ้าไม่ต้องการแจ้งก็ปิดส่วนนี้ไปก็ได้
                                $failMessage = json_encode($response->getHTTPStatus() . ' ' . $response->getRawBody());
                                $replyData = new TextMessageBuilder($failMessage);
                                break;                                                                                                                                                                                                                                          
                            default:
                                $textReplyMessage = " คุณไม่ได้พิมพ์ ค่า ตามที่กำหนด";
                                $replyData = new TextMessageBuilder($textReplyMessage);         
                                break;                                      
                        }
                        break;      
                    case (preg_match('/image|audio|video/',$typeMessage) ? true : false) :
                        Log::info("x4");
                        $response = $bot->getMessageContent($idMessage);
                        if ($response->isSucceeded()) {
                            // คำสั่ง getRawBody() ในกรณีนี้ จะได้ข้อมูลส่งกลับมาเป็น binary 
                            // เราสามารถเอาข้อมูลไปบันทึกเป็นไฟล์ได้
                            $dataBinary = $response->getRawBody(); // return binary
                            // ดึงข้อมูลประเภทของไฟล์ จาก header
                            $fileType = $response->getHeader('Content-Type');    
                            switch ($fileType){
                                case (preg_match('/^image/',$fileType) ? true : false):
                                    list($typeFile,$ext) = explode("/",$fileType);
                                    $ext = ($ext=='jpeg' || $ext=='jpg')?"jpg":$ext;
                                    $fileNameSave = time().".".$ext;
                                    break;
                                case (preg_match('/^audio/',$fileType) ? true : false):
                                    list($typeFile,$ext) = explode("/",$fileType);
                                    $fileNameSave = time().".".$ext;                        
                                    break;
                                case (preg_match('/^video/',$fileType) ? true : false):
                                    list($typeFile,$ext) = explode("/",$fileType);
                                    $fileNameSave = time().".".$ext;                                
                                    break;                                                      
                            }
                            $botDataFolder = 'botdata/'; // โฟลเดอร์หลักที่จะบันทึกไฟล์
                            $botDataUserFolder = $botDataFolder.$userID; // มีโฟลเดอร์ด้านในเป็น userId อีกขั้น
                            if(!file_exists($botDataUserFolder)) { // ตรวจสอบถ้ายังไม่มีให้สร้างโฟลเดอร์ userId
                                mkdir($botDataUserFolder, 0777, true);
                            }   
                            // กำหนด path ของไฟล์ที่จะบันทึก
                            $fileFullSavePath = $botDataUserFolder.'/'.$fileNameSave;
                            file_put_contents($fileFullSavePath,$dataBinary); // ทำการบันทึกไฟล์
                            $textReplyMessage = "บันทึกไฟล์เรียบร้อยแล้ว $fileNameSave";
                            $replyData = new TextMessageBuilder($textReplyMessage);
                            break;
                        }
                        $failMessage = json_encode($idMessage.' '.$response->getHTTPStatus() . ' ' . $response->getRawBody());
                        $replyData = new TextMessageBuilder($failMessage);  
                        break;                                                      
                    default:
                        $textReplyMessage = json_encode($events);
                        $replyData = new TextMessageBuilder($textReplyMessage);         
                        break;  
                }
            }

            $response = $bot->replyMessage($replyToken,$replyData);
            if ($response->isSucceeded()) {
                echo 'Succeeded!';
                return;
            }
            
        }


        
        // Failed
        //echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
    }

    public function profileChatbot(Request $request){

        //Define access token and chanel scret
        $access_token = "nMG7V+hlPWK+9iZAu+fp6ITOZugvpV6D2mxFqtpbd3FDHlW4x25pTo+6ydMOFrGEeQRNLLt2aXQNykt2WLHxOv7RZiLsCuiVzK3UNEh08JmGzHBjcntwSRqt/6EwQRVKcaXA2zwNT6tazsCmQ2ReFgdB04t89/1O/w1cDnyilFU=";
        $channel_secret = "c3cc836abbc74e85377d551f6b8cf3d2";

        //Connect line API
        $httpClient = new CurlHTTPClient($access_token);
        $bot = new LINEBot($httpClient, ['channelSecret' => $channel_secret]);

        $signature = $request->header('X-Line-Signature');
        $body = $request->getContent();
        try {
            $events = $bot->parseEventRequest($body, $signature);
        } catch (\Exception $e) {
            return response($e->getMessage(), 400);
        }
        
        //Check type of message [ text, image, video, etc.]
        foreach ($events as $event) {
            if (!($event instanceof TextMessage)) {
                continue;
            }

            //Get reply token
            $replyToken = $event->getReplyToken();

            //Get user profile
            $response = $bot->getProfile($event->getUserId());                        
            if ($response->isSucceeded()) {            
                $userData = $response->getJSONDecodedBody();
                // $userData['userId']
                // $userData['displayName']
                // $userData['pictureUrl']
                // $userData['statusMessage']
                $textReplyMessage = 'สวัสดีครับ คุณ '.$userData['displayName'];             
                $replyData = new TextMessageBuilder($textReplyMessage);                              
                
                //Reply message
                $response = $bot->replyMessage($replyToken,$replyData);
                if ($response->isSucceeded()) {
                    return response('Succeeded!', $response->getHTTPStatus());
                }else{
                    return response('Failed!', $response->getHTTPStatus());
                }  

            }
            break;
        }
    }


    public function textChatbot(Request $request)
    {
        $access_token = "nMG7V+hlPWK+9iZAu+fp6ITOZugvpV6D2mxFqtpbd3FDHlW4x25pTo+6ydMOFrGEeQRNLLt2aXQNykt2WLHxOv7RZiLsCuiVzK3UNEh08JmGzHBjcntwSRqt/6EwQRVKcaXA2zwNT6tazsCmQ2ReFgdB04t89/1O/w1cDnyilFU=";
        $channell_secret = "c3cc836abbc74e85377d551f6b8cf3d2";

        $httpClient = new CurlHTTPClient($access_token);
        $bot = new LINEBot($httpClient, ['channelSecret' => $channell_secret]);

        $signature = $request->header('X-Line-Signature');
        $body = $request->getContent();
        try {
            $events = $bot->parseEventRequest($body, $signature);
        } catch (\Exception $e) {
            return response($e->getMessage(), 400);
        }
        
        foreach ($events as $event) {
            if (!($event instanceof TextMessage)) {
                continue;
            }
            $replyToken = $event->getReplyToken();//Token ที่ใช้ส่งข้อความกลับ
            $message = $event->getText();//ข้อความที่ส่งมาจาก users

            if($message == "สวัสดี" || $message == "สวัสดีครับ" || $message == "สวัสดีค่ะ"){
                //ส่งกลับเป็นข้อความ
                $text = "สวัสดีคร้าบบ";
                $textMessage = new TextMessageBuilder($text);
    
                //ส่งกลับเป็นภาพ             
                $url = str_replace("http","https", $request->root());
                $originalContentUrl = $url."/assets/product/shirt.png";
                $previewImageUrl = $url."/assets/product/shirt.png";
                $imageMessage = new ImageMessageBuilder($originalContentUrl, $previewImageUrl);
    
                //ส่งกลับสติกเกอร์
                //https://developers.line.biz/en/docs/messaging-api/sticker-list/#sticker-definitions
                $packageId = "1070";
                $stickerId = "17839";
                $stickerMessage = new StickerMessageBuilder($packageId, $stickerId);                                
    
                //ส่งกลับเป็นพิกัดละติจูด-ลองจิจูด
                $placeName = "ที่ตั้งร้าน";
                $placeAddress = "ร้านช้อปดี";
                $latitude = 13.778365013248951;
                $longitude = 100.55670575421117;
                $locationMessage = new LocationMessageBuilder($placeName, $placeAddress, $latitude ,$longitude);                
    
                $replyData =  new MultiMessageBuilder;
                $replyData->add($textMessage);                
                $replyData->add($imageMessage);   
                $replyData->add($stickerMessage); 
                $replyData->add($locationMessage);
                $bot->replyMessage($replyToken, $replyData); 

            }else{            
                $replyData = new TextMessageBuilder("ไม่เข้าใจคำถาม กรุณาสอบถามอีกครั้ง");
                $bot->replyMessage($replyToken, $replyData); 
            }            
            

            if (!$response->isSucceeded()) {
                return response('Failed!', 400);
            }
        }    

        
        return response('OK', 200);
    }    


    public function chatbot(Request $request)
    {
        $access_token = "nMG7V+hlPWK+9iZAu+fp6ITOZugvpV6D2mxFqtpbd3FDHlW4x25pTo+6ydMOFrGEeQRNLLt2aXQNykt2WLHxOv7RZiLsCuiVzK3UNEh08JmGzHBjcntwSRqt/6EwQRVKcaXA2zwNT6tazsCmQ2ReFgdB04t89/1O/w1cDnyilFU=";
        $channell_secret = "c3cc836abbc74e85377d551f6b8cf3d2";

        $httpClient = new CurlHTTPClient($access_token);
        $bot = new LINEBot($httpClient, ['channelSecret' => $channell_secret]);

        $signature = $request->header('X-Line-Signature');
        $body = $request->getContent();
        try {
            $events = $bot->parseEventRequest($body, $signature);
        } catch (\Exception $e) {
            return response($e->getMessage(), 400);
        }

        foreach ($events as $event) {
            if (!($event instanceof \LINE\LINEBot\Event\MessageEvent)) {
                continue;
            }
            if (!($event instanceof \LINE\LINEBot\Event\MessageEvent\TextMessage)) {
                continue;
            }

            $message = $event->getText();

            if($message == "สวัสดี" || $message == "สวัสดีครับ" || $message == "สวัสดีค่ะ"){
                $text = "สวัสดี Shopdee ยินดีต้อนรับ มีอะไรให้ช่วยมั๊ยครับ";
            }else if($message == "ต้องการซื้อเสื้อ" || $message == "เสื้อ" || $message == "ซื้อเสื้อ"){
                $text = "เราขอแนะนำเสื้อแขนยาว ราคา 199 บาท จะ F เลยมั๊ย";
            }else if($message == "ok" || $message == "ได้" || $message == "ครับ"){
                $text = "ขอบคุณที่ซื้อสินค้าเราครับ";
            }
            
            $response = $bot->replyMessage(
                $event->getReplyToken(),
                new TextMessageBuilder($text)
            );
            if (!$response->isSucceeded()) {
                return response('Failed!', 400);
            }
        }


        
        return response('OK', 200);
    }
}
