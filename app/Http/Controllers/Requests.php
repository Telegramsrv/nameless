<?php
namespace App\Http\Controllers;
use GuzzleHttp;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

class Requests extends Controller
{
    /*public function call(){
        $message = '';
        foreach ($_REQUEST AS $key => $value){
            $message .= "$key => $value ($_SERVER[REQUEST_METHOD])\n";
        }
        $input = file_get_contents("php://input");
        $array = print_r(json_decode($input, true), true);
        file_put_contents('fbmessenger.txt', $message.$array."\nREQUEST_METHOD: $_SERVER[REQUEST_METHOD]\n----- Request Date: ".date("d.m.Y H:i:s")." IP: $_SERVER[REMOTE_ADDR] -----\n\n", FILE_APPEND);
        echo $_REQUEST['hub_challenge'];

    curl -X POST -H "Content-Type: application/json" -d '{
  "message_creative_id": <BROADCAST_MESSAGE_ID>,
  "notification_type": "<REGULAR | SILENT_PUSH | NO_PUSH>",
  "tag": "<MESSAGE_TAG>"
}' "https://graph.facebook.com/v2.11/me/broadcast_messages?access_token=<PAGE_ACCESS_TOKEN>"

    }*/
    public function call(){
        include 'Home.php';
        $bot = new Home();
        $bot->setHubVerifyToken = env('WEBHOOK_VERIFY_TOKEN');
        $bot->setaccessToken = env('FACEBOOK_APP_TOKEN');
        $message = '';
        foreach ($_REQUEST AS $key => $value){
            $message .= "$key => $value ($_SERVER[REQUEST_METHOD])\n";
        }
        $input = file_get_contents("php://input");
        dd($input);

        $array = print_r(json_decode($input, true), true);
        file_put_contents('fbmessenger.txt', $message.$array."\nREQUEST_METHOD: $_SERVER[REQUEST_METHOD]\n----- Request Date: ".date("d.m.Y H:i:s")." IP: $_SERVER[REMOTE_ADDR] -----\n\n", FILE_APPEND);
        echo $_REQUEST['hub_challenge'];

        $input = json_decode(file_get_contents('php://input'), true);
        $message = $bot->readMessage($input);
        $textmessage = $bot->sendMessage($message);

    }
/*$tokken = $_REQUEST['hub_verify_token'];
        $hubVerifyToken = env('WEBHOOK_VERIFY_TOKEN');
        $challange = $_REQUEST['hub_challenge'];
        $accessToken = env('FACEBOOK_APP_TOKEN');
        $bot = new FbBot();
        $bot->setHubVerifyToken($hubVerifyToken);
        $bot->setaccessToken($accessToken);
        echo $bot->verifyTokken($tokken,$challange);

        $input = json_decode(file_get_contents('php://input'), true);
        $message = $bot->readMessage($input);
        $textmessage = $bot->sendMessage($message);*/

}

