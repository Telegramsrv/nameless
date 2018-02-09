
<!DOCTYPE html>

<html>

<head>

    <link rel="stylesheet" href="{{ URL::asset('/css/style.css') }}" />
    <title>MessangerBot</title>
</head>

<body >
    (function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.com/en_US/messenger.Extensions.js";
    fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'Messenger'));

</body>

</html>

<?php
    require '../vendor/autoload.php';
    //use BotMan\BotMan\BotMan;
    //use BotMan\BotMan\BotManFactory;
    use Mpociot\BotMan\BotMan;
    use Mpociot\BotMan\BotManFactory;
    use Illuminate\Http\Requests;
    //use GuzzleHttp;
    $config = [
    'token' => 'EAACmdQnMmsYBAEH1WaXOvPBY38cI5dYBSF9BqeO71iPYEeDZB1kIZA5HR4j9DOij0eU2ilJHRyrd1rB7s9iVKkZCwmjl9C5Ti9HhoLRZCPRSe1wakk8ExyxzoZA3nxZASdx7Vl7gXCiX2XzHSolG0hUTiWrXJr0FECC62sVbnNVuabWG8ZAIKGZA',
    'app_secret' => 'd52b2f62d6f88d725062427173ea77d9',
    //'verification'=>'efkegkmekgfmks3434354325jidgsksdg',
    ];
    //MessengerExtensions.askPermission(success, error, permission);

    //$request_url =Requests::API_URL . '/v2.6/me/messages?access_token=' . env('FACEBOOK_TOKEN');
    //$client = new GuzzleHttp\Client();
    //$response = $client->get('GET','https://graph.facebook.com/v2.6/me/messages?access_token='. env('FACEBOOK_TOKEN') );
    //$obj = json_decode($response->getBody());

    // Create an instance
    //$botman = BotManFactory::create($config);
    //$botman->verifyServices('efkegkmekgfmks3434354325jidgsksdg');
    // Give the bot something to listen for.
    //$botman->hears('hello', function (BotMan $bot) {
    //$bot->reply('Hello yourself.');
    //});
    //$botman->hears('ciao', function (BotMan $bot) {
    //$bot->reply('ciao');
    //});
    //$botman->listen();

    //$parameters = [
    //'messaging_type' => 'UPDATE',
    //"recipient": {
    //"id": "<PSID>"
        //},
        //"message": {
        //"text": "hello, world!"
        //}
        //];
        //https://graph.facebook.com/v2.6/me/messages?access_token=

        $fb = new \Facebook\Facebook([
        'app_id' => '{'.env('FACEBOOK_APP_ID').'}',
        'app_secret' => '{'.env('FACEBOOK_APP_SECRET').'}',
        'default_graph_version' => 'v2.10',
        'default_access_token' => '{'.env('USER_ACCESS_TOKEN').'}', // optional
        ]);

        // Use one of the helper classes to get a Facebook\Authentication\AccessToken entity.
        //   $helper = $fb->getRedirectLoginHelper();
        //   $helper = $fb->getJavaScriptHelper();
        //   $helper = $fb->getCanvasHelper();
        //   $helper = $fb->getPageTabHelper();

        try {
        // Get the \Facebook\GraphNodes\GraphUser object for the current user.
        // If you provided a 'default_access_token', the '{access-token}' is optional.
        $response = $fb->get('/me');
        } catch(\Facebook\Exceptions\FacebookResponseException $e) {
        // When Graph returns an error
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
        }

        $me = $response->getGraphUser();
        echo 'Logged in as ' . $me->getName();