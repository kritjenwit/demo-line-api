<?php

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('<channel access token>');
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '<channel secret>']);
$response = $bot->replyText('<reply token>', 'hello!');
// $textMessageBuilder variable will call the constructor of \LINE\LINEBot\MessageBuilder\TextMessageBuilder and its argument is text to be send
$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello');
// $response will send the data to user followed replytoken of the user
$response = $bot->replyMessage('<reply token>', $textMessageBuilder);
if ($response->isSucceeded()) {
    echo 'Succeeded!';
    return;
}

// Failed
echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
