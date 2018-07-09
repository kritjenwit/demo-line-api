<?php



require 'line_access.php';
require 'vendor/autoload.php';

$access_token = ACCESS_TOKEN;
$channelSecret = CHANNEL_SECRET;
$pushID = USER_ID;

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);

// ------------------------------------- USE LINE CLASS ---------------------------------------------------
										
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use \LINE\LINEBot\MessageBuilder\LocationMessageBuilder;
use \LINE\LINEBot\MessageBuilder\StickerMessageBuilder;
use \LINE\LINEBot\MessageBuilder\ImageMessageBuilder;
use \LINE\LINEBot\MessageBuilder\MultiMessageBuilder;
use \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use \LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder;
use \LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder;
use \LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder; 
use \LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
use \LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder;


// ------------------------------------- GET PROFILE DATA SENT FROM USER'S LINE ---------------------------------

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);




if(!is_null($events['events'])){

	//----------------  CHECK MSG TYPE -----------------

	// $replyToken = $events['events'][0]['replyToken'];

	// $msg = new TextMessageBuilder(json_encode($events));

	// $response = $bot->replyMessage($replyToken, $msg);

	//---------------------------------------------------


	foreach ($events['events'] as $event) {
		
		$replyToken = $event['replyToken'];
		$user_id = $event['source']['userId'];
		$msgType = $event['message']['type'];


// ---------------------------------------------------------------------------------------------------------
		
		// ----------------------- If message type is text DO HERE -----------------------------
		if($msgType == 'text'){
			$msg = trim(strtolower($event['message']['text']));
			if($msg == 'hello' || $msg == 'yoo' || $msg == 'สวัสดี' || $msg == 'หวัดดี'){
				$rnd = rand(0,2);
				if($rnd ==  0){
					$textMsg = new TextMessageBuilder('Hello, How are you today?');
					$stkMsg = new StickerMessageBuilder('1','120');
					// Message to be sends
					$multiMsg = new MultiMessageBuilder;
					$multiMsg->add($textMsg);
					$multiMsg->add($stkMsg);
				}elseif($rnd ==  1){
					$textMsg = new TextMessageBuilder('Hello, How can i help you?');
					$stkMsg = new StickerMessageBuilder('1','122');
					// Message to be sends
					$multiMsg = new MultiMessageBuilder;
					$multiMsg->add($textMsg);
					$multiMsg->add($stkMsg);
				}elseif($rnd ==  2){
					$textMsg = new TextMessageBuilder('สวัสดี');
					$stkMsg = new StickerMessageBuilder('1','118');
					// Message to be sends
					$multiMsg = new MultiMessageBuilder;
					$multiMsg->add($textMsg);
					$multiMsg->add($stkMsg);
				}
			}
			elseif($msg == 'you'){
				$rnd = rand(0,1);
				if($rnd == 0){
					$textMsg = new TextMessageBuilder('What');
					// Message to be sends
					$multiMsg = new MultiMessageBuilder;
					$multiMsg->add($textMsg);
				}
				else{
					$textMsg = new TextMessageBuilder('Wassup Bro');
					// Message to be sends
					$multiMsg = new MultiMessageBuilder;
					$multiMsg->add($textMsg);
				}
			}
			elseif($msg == 'pokemon'){
				$textMsg = new TextMessageBuilder('Pikachu');
				// Message to be sends
				$multiMsg = new MultiMessageBuilder;
				$multiMsg->add($textMsg);
			}
			elseif($msg == 'goodbye'){
				$textMsg = new TextMessageBuilder('Bye Bye!');
				// Message to be sends
				$multiMsg = new MultiMessageBuilder;
				$multiMsg->add($textMsg);
			}
			elseif($msg == 'location'){
				$locMsg = new LocationMessageBuilder('AI System','71 GP House Floor2 Sipraya Bangrak Bangkok แขวง บางรัก เขต บางรัก กรุงเทพมหานคร 10500','13.7305581','100.5271074');
				$multiMsg = new MultiMessageBuilder;
				$multiMsg->add($locMsg);
			}
			elseif($msg == 'confirm'){
				$confTemp = new TemplateMessageBuilder('Confirm Template',
					new ConfirmTemplateBuilder('Confirm template builder', array(
						new MessageTemplateActionBuilder('Yes','Text Yes'),
						new MessageTemplateActionBuilder('No', 'Text No'),
					))
				);
				$multiMsg = new MultiMessageBuilder;
				$multiMsg->add($confTemp);
			}

			elseif($msg == 'travel'){

				$actionBuilder = array(
	            	new UriTemplateActionBuilder(
		                'Thailand',
		                'https://www.lonelyplanet.com/thailand'
			        ),
			        new UriTemplateActionBuilder(
		                'India',
		                'https://www.lonelyplanet.com/india'
			        ),
			        new UriTemplateActionBuilder(
		                'Vietname',
		                'https://www.lonelyplanet.com/vietnam'
			        ),
			        new UriTemplateActionBuilder(
		                'Lonelyplanet',
		                'https://www.lonelyplanet.com/search?'
			        )
				);

				$butttonTemp = new TemplateMessageBuilder(
					'Button Template',
					new ButtonTemplateBuilder(
						'Button Template Builder',
						'please select',
						'https://pbs.twimg.com/profile_images/659349744532246528/oJDWTI75_400x400.png',
						$actionBuilder
					)
				);
								
				$multiMsg = new MultiMessageBuilder;
				$multiMsg->add($butttonTemp);
			}

			elseif($msg == 'social media'){

				$actionBuilder = array(
	            	new UriTemplateActionBuilder(
		                'Facebook',
		                'https://www.facebook.com'
			        ),
			        new UriTemplateActionBuilder(
		                'Instragram',
		                'https://www.instragram.com'
			        ),
			        new UriTemplateActionBuilder(
		                'Twitter',
		                'https://www.twitter.com/'
			        ),
			        new UriTemplateActionBuilder(
		                'Other',
		                'https://www.google.com'
			        )
				);

				$butttonTemp = new TemplateMessageBuilder(
					'Button Template',
					new ButtonTemplateBuilder(
						'Button Template Builder',
						'please select',
						'https://cdn.dribbble.com/users/2087607/screenshots/4394562/free-black-white-social-media-icons-download-png-svg-jpg.gif',
						$actionBuilder
					)
				);
								
				$multiMsg = new MultiMessageBuilder;
				$multiMsg->add($butttonTemp);
			}

			// -------------- If cannot find message ------------------
			else{
				$textMsg = new TextMessageBuilder('Please try again!');
				// Message to be sends
				$multiMsg = new MultiMessageBuilder;
				$multiMsg->add($textMsg);
			}
			// --------------------------------------------------------
		}

		// ----------------------- If message type is sticker DO HERE -----------------------------
		elseif ($msgType == 'sticker') {
			$textMsg = new TextMessageBuilder('Sticker sent');
			// Message to be sends
			$multiMsg = new MultiMessageBuilder;
			$multiMsg->add($textMsg);

		}		
		// ----------------------- If message type is image DO HERE -----------------------------
		elseif ($msgType == 'image') {
			$textMsg = new TextMessageBuilder('Image sent');
			// Message to be sends
			$multiMsg = new MultiMessageBuilder;
			$multiMsg->add($textMsg);
		}		
	}
	// Code to reply to send message user
	$response = $bot->replyMessage($replyToken, $multiMsg);
}

echo 'Webhook is working';