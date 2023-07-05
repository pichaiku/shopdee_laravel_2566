<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
//use LINE\LINEBot\Event;
//use LINE\LINEBot\Event\BaseEvent;
//use LINE\LINEBot\Event\MessageEvent;
use LINE\LINEBot\MessageBuilder;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\MessageBuilder\StickerMessageBuilder;
use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;
use LINE\LINEBot\MessageBuilder\LocationMessageBuilder;
use LINE\LINEBot\MessageBuilder\AudioMessageBuilder;
use LINE\LINEBot\MessageBuilder\VideoMessageBuilder;
use LINE\LINEBot\ImagemapActionBuilder;
use LINE\LINEBot\ImagemapActionBuilder\AreaBuilder;
use LINE\LINEBot\ImagemapActionBuilder\ImagemapMessageActionBuilder ;
use LINE\LINEBot\ImagemapActionBuilder\ImagemapUriActionBuilder;
use LINE\LINEBot\MessageBuilder\Imagemap\BaseSizeBuilder;
use LINE\LINEBot\MessageBuilder\ImagemapMessageBuilder;
use LINE\LINEBot\MessageBuilder\MultiMessageBuilder;
use LINE\LINEBot\TemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\DatetimePickerTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselColumnTemplateBuilder;

class ChatbotOldController extends Controller
{    
    public function chatbot()
    {
        $accessToken = "/1+2TmrOmK1PmVtl8gAAS93e8V7+ikGOC9vDPccVyGgiWFlHrMLZ/5jqfDoRnAkBbINXquGo1zHqEWrPKKdC7bomOdOE9DyaDXSjHwNGEzeP10bMzEIf6KMXuWek48hH67LnkiIHATdXP5AdZsxpKQdB04t89/1O/w1cDnyilFU="; //line access token
        $channel_secret = "82c74657c8fe9f569528c3e4205faa18";
        // เชื่อมต่อกับ LINE Messaging API
        $httpClient = new CurlHTTPClient($accessToken);
        $bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));
        
        // คำสั่งรอรับการส่งค่ามาของ LINE Messaging API
        $content = file_get_contents('php://input');
        
        // แปลงข้อความรูปแบบ JSON  ให้อยู่ในโครงสร้างตัวแปร array
        $events = json_decode($content, true);
        if(!is_null($events)){
            // ถ้ามีค่า สร้างตัวแปรเก็บ replyToken ไว้ใช้งาน
            $replyToken = $events['events'][0]['replyToken'];
        }
        // ส่วนของคำสั่งจัดเตียมรูปแบบข้อความสำหรับส่ง
        $textMessageBuilder = new TextMessageBuilder(json_encode($events));
        
        //l ส่วนของคำสั่งตอบกลับข้อความ
        $response = $bot->replyMessage($replyToken,$textMessageBuilder);
        if ($response->isSucceeded()) {
            echo 'Succeeded!';
            return;
        }
        
        // Failed
        echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
    }
    public function xchatbot()
    {                   
        //กำหนด access token และ header สำหรับ return message ไปยัง users
        $accessToken = "c0MuZUSy4d3BbDYkAfEzMkeXvDf90ihT7pMM7S52swKmP2S/cupa6AOJCudemHsXbINXquGo1zHqEWrPKKdC7bomOdOE9DyaDXSjHwNGEzdNgmzgSwOPdKbMYm0bGMvcLLZctY7IEqZs2Qsf6bRTqgdB04t89/1O/w1cDnyilFU="; //line access token
        $arrayHeader = array();
        $arrayHeader[] = "Content-Type: application/json";
        $arrayHeader[] = "Authorization: Bearer {$accessToken}";
        
        //รับข้อความจากผู้ใช้
        $content = file_get_contents('php://input');
        $arrayJson = json_decode($content, true);            
        $messageType = $arrayJson['events'][0]['message']['type'];
        $messageId = $arrayJson['events'][0]['message']['id'];
        $userid = $arrayJson["events"][0]["source"]["userId"];        
        $timestamp = $arrayJson["events"][0]["timestamp"]; 
        $replyToken = $arrayJson['events'][0]['replyToken'];  


        // $httpClient = new CurlHTTPClient(LINE_MESSAGE_ACCESS_TOKEN);
        // $bot = new LINEBot($httpClient, array('channelSecret' => LINE_MESSAGE_CHANNEL_SECRET));
        // $textMessageBuilder = new TextMessageBuilder(json_encode($events));
 
        // //l ส่วนของคำสั่งตอบกลับข้อความ
        // $response = $bot->replyMessage($replyToken,$textMessageBuilder);
        // if ($response->isSucceeded()) {
        //     echo 'Succeeded!';
        //     return;
        // }

        Bot::replyText();

        $profile = \LINEBot::getProfile($userid);
        $data = ChatbotController::getImage($accessToken, $messageId);       
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = print_r($profile);  
        ChatbotController::replyMsg($arrayHeader,$arrayPostData);   

        // $results = ChatbotController::getContent($accessToken, $messageId);

        // if($results['result'] == 'S'){
        //     $file = 'C:\\xampp\\htdocs\\shoppee\\public\\assets\\line\\' . uniqid() . '.png';            
        //     file_put_contents($file, $results['response']);

        //     $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        //     $arrayPostData['messages'][0]['type'] = "text";
        //     $arrayPostData['messages'][0]['text'] = strlen($results['response']);  
        //     ChatbotController::replyMsg($arrayHeader,$arrayPostData);                
        // }
                           
        exit;

        #ตัวอย่าง Message Type "Text" และ "Sticker"
        #https://developers.line.biz/en/docs/messaging-api/sticker-list/        
        if($message == "สวัสดี" || $message == "สวัสดีค่ะ" || $message == "สวัสดีครับ"){
            $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = "สวัสดีค่ะ ฟู้ดดี ยินดีต้อนรับ";

            $arrayPostData['messages'][1]['type'] = "sticker";
            $arrayPostData['messages'][1]['packageId'] = "6359";
            $arrayPostData['messages'][1]['stickerId'] = "11069861";
            
            ChatbotController::replyMsg($arrayHeader,$arrayPostData);
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
            
            ChatbotController::replyMsg($arrayHeader,$arrayPostData);            
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
            
            ChatbotController::replyMsg($arrayHeader,$arrayPostData);            
        }
        else if($message == "สั่งอาหาร" || $message == "ขอสั่งอาหาร"){
            $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = "รับอะไรดีคะ";
            
            ChatbotController::replyMsg($arrayHeader,$arrayPostData);
        }
        else if($message == "ผัดซีอิ๊ว"){
            $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = "รับอะไรอีกไหมคะ";

            //add log
            $sql = "INSERT INTO chatlog(userid,message,timestamp) 
                    VALUES ('$userid','$message','$timestamp')";
            DB::insert($sql);           

            ChatbotController::replyMsg($arrayHeader,$arrayPostData);
        }
        else if($message == "กระเพาหมูสับไข่ดาวราดข้าว"){
            $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = "รับอะไรอีกไหมคะ";

            //add log
            $sql = "INSERT INTO chatlog(userid,message,timestamp) 
                    VALUES ('$userid','$message','$timestamp')";
            DB::insert($sql);  

            ChatbotController::replyMsg($arrayHeader,$arrayPostData);
        }        
        else if($message == "ข้าวไข่เจียวกุ้งสับ"){
            $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = "รับอะไรอีกไหมคะ";

            //add log
            $sql = "INSERT INTO chatlog(userid,message,timestamp) 
                    VALUES ('$userid','$message','$timestamp')";
            DB::insert($sql);  

            ChatbotController::replyMsg($arrayHeader,$arrayPostData);
        }  
        else if($message == "ไม่ค่ะ" || $message == "ไม่ครับ" || $message == "ไม่"){
            $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = "ฟู้ดดี ยินดีที่ได้ให้บริการค่ะ";            

            $arrayPostData['messages'][1]['type'] = "sticker";
            $arrayPostData['messages'][1]['packageId'] = "6359";
            $arrayPostData['messages'][1]['stickerId'] = "11069856";

            ChatbotController::replyMsg($arrayHeader,$arrayPostData);
        }
        else if($message == "ทำนาย" || $message == "ภาพ" || $message == "ทำนายภาพ"){
            $path = "C:\\xampp\\htdocs\\shoppee\\app\\python\\test_object_detect.py";
            $filename = "C:\\Users\\HP\\data\\images\\test\\9338527.1.jpg"; 
                    
            ob_start();
            passthru("python $path $filename");         
            $data = preg_replace('~[\r\n]+~', '', ob_get_clean()); 
            //$data = "ใช่x";

            $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = $data;  
             
            ChatbotController::replyMsg($arrayHeader,$arrayPostData);  

        }else{
            // $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
            // $arrayPostData['messages'][0]['type'] = "text";
            // $arrayPostData['messages'][0]['text'] = "พูดอีกครั้งได้ไหมคะ";  
             
            $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = "พูดอีกครั้งได้ไหมคะ";              
            ChatbotController::replyMsg($arrayHeader,$arrayPostData);          
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

    function getImage($token,$messageId){
        $url_content="https://api.line.me/v2/bot/message/".$messageId."/content";

        $headers = array("Authorization: Bearer " . $token);
        
        $ch = curl_init($url_content);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
        $data =curl_exec($ch);
        curl_close($ch);
        $fp = "assets/line/".$messageId.".png";
        //$url_img="http://103.40.151.6/line_bot_gts_issue/".$fp;
        file_put_contents( $fp, $data );  
        return $data;      
    }

    function getContent($token,$messageId){
        $datasReturn = [];
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL =>   "https://api.line.me/v2/bot/message/".$messageId."/content",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => "",
        CURLOPT_HTTPHEADER => array(
            "Content-Type: image",
            "Authorization: Bearer ".$token,
            "cache-control: no-cache"
        ),
        ));
        $response = curl_exec($curl);        
        $err = curl_error($curl);


        // $arrayHeader[] = "Content-Type: application/json";
        // $arrayHeader[] = "Authorization: Bearer {$accessToken}";

        curl_close($curl);
        if($err){
            $datasReturn['result'] = 'E';
            $datasReturn['message'] = $err;            
        }else{
            $datasReturn['result'] = 'S';
            $datasReturn['message'] = 'Success';
            $datasReturn['response'] = $response;            
        }
        return $datasReturn;
    }    
}