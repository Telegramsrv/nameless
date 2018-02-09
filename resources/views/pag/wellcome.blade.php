<?php
    require '../vendor/autoload.php';
    use Mpociot\BotMan\BotMan;
    use Mpociot\BotMan\BotManFactory;
    use Illuminate\Http\Requests;
    $config = [
        'token' => 'EAACmdQnMmsYBAEH1WaXOvPBY38cI5dYBSF9BqeO71iPYEeDZB1kIZA5HR4j9DOij0eU2ilJHRyrd1rB7s9iVKkZCwmjl9C5Ti9HhoLRZCPRSe1wakk8ExyxzoZA3nxZASdx7Vl7gXCiX2XzHSolG0hUTiWrXJr0FECC62sVbnNVuabWG8ZAIKGZA',
        'app_secret' => 'd52b2f62d6f88d725062427173ea77d9',
    ];

    $fb = new \Facebook\Facebook([
        'app_id' => '{'.env('FACEBOOK_APP_ID').'}',
        'app_secret' => '{'.env('FACEBOOK_APP_SECRET').'}',
        'default_graph_version' => 'v2.10',
        'default_access_token' => '{'.env('USER_ACCESS_TOKEN').'}', // optional
    ]);
    try {
        $response = $fb->get('/me');
    } catch(\Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch(\Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }

    $me = $response->getGraphUser();
    echo 'Logged in as ' . $me->getName();