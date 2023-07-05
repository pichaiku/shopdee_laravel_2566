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
// //use LINE\LINEBot\Event;
// //use LINE\LINEBot\Event\BaseEvent;
// //use LINE\LINEBot\Event\MessageEvent;
// use LINE\LINEBot\HTTPClient;
// use LINE\LINEBot\MessageBuilder;
// use LINE\LINEBot\MessageBuilder\StickerMessageBuilder;
// use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;

// use LINE\LINEBot\MessageBuilder\AudioMessageBuilder;
// use LINE\LINEBot\MessageBuilder\VideoMessageBuilder;
// use LINE\LINEBot\ImagemapActionBuilder;
// use LINE\LINEBot\ImagemapActionBuilder\AreaBuilder;
// use LINE\LINEBot\ImagemapActionBuilder\ImagemapMessageActionBuilder ;
// use LINE\LINEBot\ImagemapActionBuilder\ImagemapUriActionBuilder;
// use LINE\LINEBot\MessageBuilder\Imagemap\BaseSizeBuilder;
// use LINE\LINEBot\MessageBuilder\ImagemapMessageBuilder;
// use LINE\LINEBot\TemplateActionBuilder;
// use LINE\LINEBot\TemplateActionBuilder\DatetimePickerTemplateActionBuilder;
// use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;
// use LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder;
// use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
// use LINE\LINEBot\MessageBuilder\TemplateBuilder;
// use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
// use LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder;
// use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder;
// use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder;
// use LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder;
// use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselTemplateBuilder;
// use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselColumnTemplateBuilder;

class ChatbotSDKController extends Controller
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
        $arrayJson = json_decode($content, true);            
        $messageType = $arrayJson['events'][0]['message']['type'];
        $messageId = $arrayJson['events'][0]['message']['id'];                
        $userid = $arrayJson["events"][0]["source"]["userId"];        
        $timestamp = $arrayJson["events"][0]["timestamp"]; 
        $replyToken = $arrayJson['events'][0]['replyToken'];  
        

        if($messageType=="text"){
            $message = $arrayJson['events'][0]['message']['text'];

            if($message=="สวัสดี"){                
                $textMessage = new TextMessageBuilder("สวัสดีคร้าบบ");
                //$bot->replyMessage($replyToken,$textMessage);

                $placeName = "ที่ตั้งร้าน";
                $placeAddress = "ร้านฟู้ดดี้";
                $latitude = 13.778365013248951;
                $longitude = 100.55670575421117;
                $locationMessage = new LocationMessageBuilder($placeName, $placeAddress, $latitude ,$longitude);                

                $replyData =  new MultiMessageBuilder;
                $replyData->add($textMessage);                
                $replyData->add($locationMessage);
                $bot->replyMessage($replyToken,$replyData);
            }
        }else if($messageType=="image" || $messageType=="audio" || $messageType=="video"){
            $response = $bot->getMessageContent($messageId);
            $binary = $response->getRawBody();

            //บันทึกไฟล์
            $file = 'assets/line/' . uniqid() . '.png';
            file_put_contents($file, $binary);

            //ตอบกลับ
            $replyData = new TextMessageBuilder("บันทึกไฟล์เรียบร้อยแล้ว");            
            $bot->replyMessage($replyToken,$replyData);
        }

        exit;
                
    }

}