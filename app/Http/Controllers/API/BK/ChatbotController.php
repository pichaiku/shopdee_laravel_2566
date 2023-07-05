<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\MessageBuilder\MultiMessageBuilder;
use LINE\LINEBot\MessageBuilder\LocationMessageBuilder;
use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;
use LINE\LINEBot\MessageBuilder\StickerMessageBuilder;

class ChatbotController extends Controller
{    

    public function chatbot()
    {

        //กำหนดค่า Access Token และ Channel Secret [นำมาจาก Line Developer]

        $accessToken = "nMG7V+hlPWK+9iZAu+fp6ITOZugvpV6D2mxFqtpbd3FDHlW4x25pTo+6ydMOFrGEeQRNLLt2aXQNykt2WLHxOv7RZiLsCuiVzK3UNEh08JmGzHBjcntwSRqt/6EwQRVKcaXA2zwNT6tazsCmQ2ReFgdB04t89/1O/w1cDnyilFU=";
        $channel_secret = "c3cc836abbc74e85377d551f6b8cf3d2";

        // เชื่อมต่อกับ LINE Messaging API
        $httpClient = new CurlHTTPClient($accessToken);
        $bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));
        
        // รับข้อมูลที่ส่งกลับมาจาก LINE Messaging API
        $content = file_get_contents('php://input');
        $arrayJson = json_decode($content, true);            
        $messageType = $arrayJson['events'][0]['message']['type'];
        $messageId = $arrayJson['events'][0]['message']['id'];                
        $userid = $arrayJson["events"][0]["source"]["userId"];        
        $timestamp = $arrayJson["events"][0]["timestamp"]; 
        $replyToken = $arrayJson['events'][0]['replyToken'];  

        $bot->replyMessage($replyToken,json_decode($arrayJson));
        exit();
        // // ถ้าค่าที่ส่งมาเป็นข้อความ
        // if($messageType=="text"){
        //     $message = $arrayJson['events'][0]['message']['text'];

        //     if($message == "สวัสดี" || $message == "สวัสดีค่ะ" || $message == "สวัสดีครับ"){            
        //         //ส่งกลับเป็นข้อความ
        //         $textMessage = new TextMessageBuilder("สวัสดีคร้าบบ");

        //         //ส่งกลับเป็นภาพ                
        //         $originalContentUrl = $url . "assets/product/shirt.png";
        //         $previewImageUrl = $url . "assets/product/shirt.png";
        //         $imageMessage = new ImageMessageBuilder($originalContentUrl, $previewImageUrl);

        //         //ส่งกลับสติกเกอร์
        //         //https://developers.line.biz/en/docs/messaging-api/sticker-list/#sticker-definitions
        //         $packageId = "1070";
        //         $stickerId = "17839";
        //         $stickerMessage = new StickerMessageBuilder($packageId, $stickerId);                                

        //         //ส่งกลับเป็นพิกัดละติจูด-ลองจิจูด
        //         $placeName = "ที่ตั้งร้าน";
        //         $placeAddress = "ร้านช้อปดี";
        //         $latitude = 13.778365013248951;
        //         $longitude = 100.55670575421117;
        //         $locationMessage = new LocationMessageBuilder($placeName, $placeAddress, $latitude ,$longitude);                

        //         $replyData =  new MultiMessageBuilder;
        //         $replyData->add($textMessage);                
        //         $replyData->add($imageMessage);   
        //         $replyData->add($stickerMessage); 
        //         $replyData->add($locationMessage);
        //         $bot->replyMessage($replyToken,$replyData);
        //     }

        // }
                
    }

}