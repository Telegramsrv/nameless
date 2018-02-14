<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use GuzzleHttp;
use GuzzleHttp\Exception\RequestException;
use Mockery\Exception;
use Mockery\Matcher\Closure;
use App\Tbl_utente;


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

    }


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
*/
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

    public function bot(Request $request){
        try{
            $message = '';
            foreach ($_REQUEST AS $key => $value){
                $message .= "$key => $value ($_SERVER[REQUEST_METHOD])\n";
            }
            $input = file_get_contents("php://input");


            $array = print_r(json_decode($input, true), true);
            file_put_contents('fbmessenger.txt', $message.$array."\nREQUEST_METHOD: $_SERVER[REQUEST_METHOD]\n----- Request Date: ".date("d.m.Y H:i:s")." IP: $_SERVER[REMOTE_ADDR] -----\n\n", FILE_APPEND);
            //echo $_REQUEST['hub_challenge'];
        }
        catch (Exception $ex){
            echo 'Fail to verify token';
        }
        $data = $_REQUEST->all();

        $id = $data["entry"][0]["messaging"][0]["sender"]["id"];
        $senderMessage = $data["entry"][0]["messaging"][0]["message"];
        if(!empty($senderMessage)){
            /*
            $new_user = new Tbl_utenti();
            $check_id_user = Tbl_utenti::where('id_user', $id_user)->get();
            if($check_id_user->isEmpty()){
                $new_user->id_utente = $id_user;
                $new_user->nome = $nome;
                $new_user->save();
            }
            */
            if($senderMessage == 'ciao'){
                $this->sendTextMessage($id, "Ciao come stai?");
            }
            if(strrpos($senderMessage, 'bene') | strrpos($senderMessage, 'benissimo') | strrpos($senderMessage, 'felice') | strrpos($senderMessage, 'contento')){
                $this->sendTextMessage($id, "Molto bene!");
            }
            if(strrpos($senderMessage, 'male') | strrpos($senderMessage, 'malissimo') | strrpos($senderMessage, 'arrabbiato') | strrpos($senderMessage, 'triste')| strrpos($senderMessage, 'malato')| strrpos($senderMessage, 'influenzato')){
                $this->sendTextMessage($id, "Caspita");
            }

        }else
        {
            $this->sendTextMessage($id, "Capito");
        }
    }

    private function sendTextMessage($recipientId, $messageText){
        $messageData = [
            "recipient" => [
                "id" => $recipientId,
            ],
            "message" => [
                "text" => $messageText,
            ],
        ];
        $ch = curl_init('https://graph.facebook.com/v2.6/me/messages?access_token=' .env('FACEBOOK_APP_TOKEN'));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["ContentType : application/json"]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, GuzzleHttp\json_encode($messageData));
        curl_exec($ch);
        curl_close($ch);
    }

    public function broadcast($messageBroadcast)
    {
        //L'API Broadcast della Piattaforma Messenger ti consente di trasmettere messaggi a tutti coloro che al momento hanno una conversazione aperta con la tua Pagina o a un insieme personalizzato di utenti.
        $data = array("message_creative_id" => "id", "notification_type" => "REGULAR", "tag" => "Broadcast");
        $data_string = json_encode($data);

        $broadcast = curl_init('https://graph.facebook.com/v2.11/me/broadcast_messages?access_token=' . env('FACEBOOK_APP_TOKEN'));
        curl_setopt($broadcast, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($broadcast, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
        );
        curl_setopt($broadcast, CURLOPT_POSTFIELDS, $data_string);

        $result = curl_exec($broadcast);
        try {
            $result["broadcast_id"];


        }catch (Exception $ex){
            curl_close($broadcast);
        }

    }

    /*


     http://thedebuggers.com/subscription-using-broadcast-api-php/
     $messageJSON =  '{
  "messages":[
    {
    "dynamic_text": {
      "text": "Hello , {{first_name}}!",
      "fallback_text": "Hello friend"
    }
  }
  ]
}';

//API Url
$api_url = 'https://graph.facebook.com/v2.11/me/message_creatives?access_token='.$access_token;

//Initiate cURL.
$ch = curl_init($api_url);
//Tell cURL that we want to send a POST request.
curl_setopt($ch, CURLOPT_POST, 1);
// Return the API response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//Attach our encoded JSON string to the POST fields.
curl_setopt($ch, CURLOPT_POSTFIELDS, $messageJSON);
//Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
//Execute the request
$result = curl_exec($ch);
curl_close($ch);
// Get Message Creative Id
$response = json_decode($result);
$message_creative_id = $response->message_creative_id;
     */

}

