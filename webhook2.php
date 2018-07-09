<?php

require_once 'vendor/autoload.php';

$access_token = '5SdL9uUr1t4w+HwmY+a9nQdPBKg02chwlDHS3SZxK9rm938IfjcvO2Y6o5YYA50G1CyEuv0RzZEm3aO0v5yy0YoXmw1cCIkW04owNaPsO21gJdlORwbtod2GIXMkpZ7iko7c3+XwyBmlOvxtEhaI/QdB04t89/1O/w1cDnyilFU=';
$channelSecret = '8e9ba131a555f81f0d4178cc58da54fe';
$pushID = 'Ue8b4d0638b780f9dde18f5806ea391a8';

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);

if(!is_null($events['events'])){

	//----------------  CHECK MSG TYPE -----------------

	$replyToken = $events['events'][0]['replyToken'];

	$msg = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder(json_encode($events));

	$response = $bot->replyMessage($replyToken, $msg);

}


// $response = $bot->replyMessage($replyToken, $multiMsg);