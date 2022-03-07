<?php
    //drinkmorewaterreminderbot
    //HTTP API TOKEN: 5130453203:AAHDdkQ3yAdp9mtahBX2qzC3zPZ_1q8jBL0
    //https://api.telegram.org/bot5130453203:AAHDdkQ3yAdp9mtahBX2qzC3zPZ_1q8jBL0/getUpdates

    function sendingMessage($bot_id, $chat_id, $message)
    {
        $url = 'https://api.telegram.org/bot' . $bot_id . '/sendMessage?text='. $message . '&chat_id=' . $chat_id;
        file_get_contents($url);
    }

$botId = "5130453203:AAHDdkQ3yAdp9mtahBX2qzC3zPZ_1q8jBL0";
$path = "https://api.telegram.org/bot5130453203:AAHDdkQ3yAdp9mtahBX2qzC3zPZ_1q8jBL0/";
$update = json_decode(file_get_contents("php://input"), TRUE);
$chatId = $update["message"]["chat"]["id"];
$message = $update["message"]["text"];
if (strpos($message, "/setreminder") === 0) 
{
    $interval = substr($message, 12);
    sendingMessage($botId, $chatId, "Your new reminder is set to: " . $interval . " Minutes"); //loops for some reason
    sleep($interval * 60); //loops for some reason
    sendingMessage($botId, $chatId, "Drink Water!"); //loops for some reason
}
if (strpos($message, "/deletereminder") === 0) //Doesnt work for some reason
{
    sendingMessage($bot_id, $chatId, "Your current reminder has been deleted. You won't get any new messages from now on: " . $interval);
}





?>