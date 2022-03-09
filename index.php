<?php
//drinkmorewaterreminderbot
//HTTP API TOKEN: 5130453203:AAHDdkQ3yAdp9mtahBX2qzC3zPZ_1q8jBL0
//https://api.telegram.org/bot5130453203:AAHDdkQ3yAdp9mtahBX2qzC3zPZ_1q8jBL0/getUpdates
//https://api.telegram.org/bot5130453203:AAHDdkQ3yAdp9mtahBX2qzC3zPZ_1q8jBL0/close

function sendingMessage($bot_id, $chat_id, $message)
{
    $url = 'https://api.telegram.org/bot' . $bot_id . '/sendMessage?text='. $message . '&chat_id=' . $chat_id;
    file_get_contents($url);
}
$botId = "5130453203:AAHDdkQ3yAdp9mtahBX2qzC3zPZ_1q8jBL0";
$update = json_decode(file_get_contents("php://input"), TRUE); //Input from Webhook
$chatId = $update["message"]["chat"]["id"];
$message = $update["message"]["text"];
if (str_contains($message, "/start"))
{
    sendingMessage($botId, $chatId, "Welcome! :)");
}
if (strpos($message, "/setreminder") === 0)
{
    $interval = substr($message, 13);
    if(is_numeric($interval))
    {
        sendingMessage($botId, $chatId, "Your new reminder is set to: " . $interval . " Minutes");
        file_put_contents("./reminders/" . $chatId, $interval); //creates file
    }
    else
    {
        sendingMessage($botId, $chatId, "Please use the comman line this: /setreminder 5 This will set a 5 minute reminder.");
    }
}
if (str_contains($message, "/deletereminder"))
{
    if (!file_exists("./reminders/" . $chatId))
    {
        sendingMessage($botId, $chatId, "Error: No Reminder was set");
    }
    else
    {
        unlink("./reminders/" . $chatId); //deletes file
        sendingMessage($botId, $chatId, "Your current reminder has been deleted. You won't get any new messages from now on. ");
    }
}
?>