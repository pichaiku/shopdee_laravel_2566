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
    public function foodchatxx(Request $request)
    {
        $access_token = "6g9i4T6Ksj7xdlroWVsPbti3DZjU8fR9Az+1DHPkNoFbIj729wH+oILcJlv9hB0nbINXquGo1zHqEWrPKKdC7bomOdOE9DyaDXSjHwNGEzfZgxF3Kw07m33Bb2xbu/mhdXxlA1FTni373Hd62+n99wdB04t89/1O/w1cDnyilFU=";
        $channel_secret = "7b6b689c20b04dfdcb2219195250c4a9";

        $http_client = new CurlHTTPClient($access_token);
        $bot = new LINEBot($http_client, ['channelSecret' => $channel_secret]);

        $signature = $_SERVER["HTTP_" . \LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];
        $body = file_get_contents("php://input");

        $events = $bot->parseEventRequest($body, $signature);

        foreach ($events as $event) {
            if ($event instanceof \LINE\LINEBot\Event\MessageEvent\ImageMessage) {
                $messageId = $event->getMessageId();
                $replyToken = $event->getReplyToken();

                // Get image content
                $response = $bot->getMessageContent($messageId);
                if ($response->isSucceeded()) {
                    $imageBinary = $response->getRawBody();
                    // Save image to disk
                    file_put_contents("assets/line/image.jpg", $imageBinary);

                    // Reply with a message
                    $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder("Thank you for sending the image!");
                    $bot->replyMessage($replyToken, $textMessageBuilder);
                }else{
                    $failMessage = json_encode($messageId.' '.$response->getHTTPStatus() . ' ' . $response->getRawBody());
                    $replyData = new TextMessageBuilder($failMessage);
                    $bot->replyMessage($replyToken, $replyData);   

                }
            }
        }
    }

    public function foodchat()
    {
        //กำหนด URL
        $url = "https://49f2-2405-9800-b640-1481-6c42-a6a7-8d89-ade0.jp.ngrok.io/";

        //กำหนดค่า Access Token และ Channel Secret [นำมาจาก Line Developer]
        //$accessToken = "6g9i4T6Ksj7xdlroWVsPbti3DZjU8fR9Az+1DHPkNoFbIj729wH+oILcJlv9hB0nbINXquGo1zHqEWrPKKdC7bomOdOE9DyaDXSjHwNGEzfZgxF3Kw07m33Bb2xbu/mhdXxlA1FTni373Hd62+n99wdB04t89/1O/w1cDnyilFU=";
        //$channel_secret = "7b6b689c20b04dfdcb2219195250c4a9";
        $accessToken = "xX2KzzHPGALQIwm4NjmuEZJB12S1czO+8f8P38i7ceSFg+OsIFxdtwwhHh/6xekwRYApCFRq2hNqLtNBlNJHrTzknRP9ZDlOf7JpYBcb2IP4nZYbQI3vDBELHfrmHtqBw6ieEEknHPZiUQfiOVTIMwdB04t89/1O/w1cDnyilFU=";
        $channel_secret = "c063ae7b3c1d71bf65ccfbdca993099b";

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
        //get content
        $response = $bot->getMessageContent($messageId);
        

        // ถ้าค่าที่ส่งมาเป็นข้อความ
        if($messageType=="text"){
            $message = $arrayJson['events'][0]['message']['text'];

            if($message == "สวัสดี" || $message == "สวัสดีค่ะ" || $message == "สวัสดีครับ"){            
                //ส่งกลับเป็นข้อความ
                $textMessage = new TextMessageBuilder("สวัสดีคร้าบบ");

                //ส่งกลับเป็นภาพ                
                $originalContentUrl = $url . "assets/product/shirt.png";
                $previewImageUrl = $url . "assets/product/shirt.png";
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
                $bot->replyMessage($replyToken,$replyData);
            }

        // ถ้าค่าที่ส่งมาเป็นภาพ
        }else if($messageType=="image"){



            if ($response->isSucceeded()) {
                //get binary image
                $binary = $response->getRawBody();

                $dataHeader = $response->getHeaders(); 
                //extension of image file
                //$fileType = $response->getHeader('Content-Type');
                // list($typeFile,$ext) = explode("/",$fileType);
                // $ext = ($ext=='jpeg' || $ext=='jpg')?"jpg":$ext;

                // //create new file name and path
                // $fileName = $userid.time().".".$ext;
                // $savePath = 'assets/line/'.$fileName;
                
                //บันทึกไฟล์            
                //file_put_contents($savePath, $binary);

                //ตอบกลับ
                $replyData = new TextMessageBuilder(json_encode($dataHeader));
                $bot->replyMessage($replyToken,$replyData);                  
            }else{            
                //$failMessage = json_encode($messageId.' '.$response->getHTTPStatus() . ' ' . $response->getRawBody());

                //$failMessage = "https://api-data.line.me/v2/bot/message/".$messageId."/content";

                //$failMessage = $arrayJson['events'][0]['message']['contentProvider']['originalContentUrl'];
                $replyData = new TextMessageBuilder($response->getHTTPStatus());
                $bot->replyMessage($replyToken,$replyData);                  
            }

        }
                
    }

}