<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\In;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
require '../vendor/autoload.php';
use GuzzleHttp;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

class New_controller extends Controller
{
    public function setup()
    {
        //https://packagist.org/packages/casperlaitw/laravel-fb-messenger
        //https://github.com/lexxyungcarter/laravel-5-messenger
        //https://casperlaitw.github.io/laravel-fb-messenger/v1.4.7/Casperlaitw/LaravelFbMessenger/Events/Broadcast.html


        $client = new GuzzleHttp\Client();

        /*return $this->call('me/messenger_profile', [
        'get_started' => ['payload' => $payload]
        ], 'POST');*/


        $response = $client->request('POST',
            'https://graph.facebook.com/v2.6/me/messenger_profile?access_token=' . env('FACEBOOK_APP_TOKEN'),
            array(
                'content-type' => 'application/json',

                'get_started' => [
                    'payload' => '<GET_STARTED_PAYLOAD>',
                ],
            )
        );
        $obj = json_decode($response->getBody());

        dd($obj);
    }

    public function login()
    {
        $client = new GuzzleHttp\Client();
        $request_user_info = $client->get('', [

        ]);

    }

    /*
    public function setGetStartedButton($payload)
    {
    return $this->call('me/messenger_profile', [
    'get_started' => ['payload' => $payload]
    ], self::TYPE_POST);
    }
    'https://graph.facebook.com/v2.6/me/messages?access_token=' . env('FACEBOOK_APP_TOKEN'),
    array(
    'messaging_type' => '',
    //RESPONSE risposta ad uno ricevuto
    'recipient' => [
    'id' => '',
    ],
    'message' => [
    'text' => 'hello, world!',
    ],);
    'tag'=> 'tag',
    'notification_type'=> 'REGULAR',
    'messaging_type' => 'RESPONSE',


    */
    public function callback()
    {
        $config = [
            'token' => env('FACEBOOK_APP_TOKEN'),
            'app_secret' => env('FACEBOOK_APP_SECRET'),
            'verification' => env('WEBHOOK_VERIFY_TOKEN'),
        ];

        // Create an instance
        $botman = BotManFactory::create($config);
        //dd ($botman);
        //$botman->verifyServices('efkegkmekgfmks3434354325jidgsksdg');
        $botman->listen();
        // Give the bot something to listen for.
        $botman->hears('hello', function (BotMan $bot) {
            $bot->reply('Hello yourself.');
        });

        // Start listening
    }

    public function broadcast_message()
    {
        $message = 'pippo';
        //<PAGE_ACCESS_TOKEN>>"

        $headers = array(
            'Content-Type' => 'application/json'
        );
        $client = new GuzzleHttp\Client();
        $response = $client->request('POST',
            'https://graph.facebook.com/v2.11/me/message_creatives?access_token=' . env('FACEBOOK_APP_TOKEN'),
            array(
                'Content-Type' => 'application/json',
                'messages' => $message,
            )
        );
        $obj = json_decode($response->getBody());

        $access_token_spotify = $obj->access_token;

        //$result['message_creative_id'];
        //curl -X POST -H "Content-Type: application/json" -d '{
        //"message_creative_id": <BROADCAST_MESSAGE_ID>,
        //"notification_type": "<REGULAR | SILENT_PUSH | NO_PUSH>",
        // "tag": "<MESSAGE_TAG>"
        //}' "https://graph.facebook.com/v2.11/me/broadcast_messages?access_token=<PAGE_ACCESS_TOKEN>"
        /*
        "use strict";
        Object.defineProperty(exports, "__esModule", { value: true });
        var messenger_bot_1 = require("@aiteq/messenger-bot");
        var bot = new messenger_bot_1.BotServer({
        name: "dearbot",
        port: 4041,
        verifyToken: "efkegkmekgfmks3434354325jidgsksdg",
        accessToken: "EAACEdEose0cBADOJhm9w1H5bTAYCrPw5cdYInKbcfQlayfeBmvhbZCBo8VwTOgjAemN1rgHNvGk3HTgFjZBKCxKITApKuH7yZCZBexxjZAglvXVWiik5XvDtvIqhKDs1EA9hukT3pAkKv5hXOKILMV3D78c3aKvCm5NBaUYjnr7OVl0nzP2yEZCq0NhntH21eCS9mZBfWo7oAZDZD",
        appSecret: "d52b2f62d6f88d725062427173ea77d9"
        });
        bot.hear("hello", function (chat) {
        chat.say("Hello! I'm Emil, the Bot. How are you?");
        });
        bot.start();
        */


    }
}