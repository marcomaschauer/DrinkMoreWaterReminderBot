<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DrinkMoreWaterReminderBot</title>
    <link rel="stylesheet" href="./style/style.css">
</head>
<body>
    <h1>Welcome to the DrinkMoreWaterReminderBot</h1>
    <img src="./image/telegram_bot.svg"/>
    <p>Scan the QR-Code above with your Telegram App to get started!</p>
</body>
</html>
<?php
error_reporting(0);
include("./scripts/conf.php");
function sendingMessage($bot_id, $chat_id, $message)
{
    $url = 'https://api.telegram.org/bot' . $bot_id . '/sendMessage?text='. $message . '&chat_id=' . $chat_id;
    file_get_contents($url);
}
$update = json_decode(file_get_contents("php://input"), TRUE); //Input from Webhook
$chatId = $update["message"]["chat"]["id"];
$message = $update["message"]["text"];
if (str_contains($message, "/start"))
{
    sendingMessage($botId, $chatId, "Welcome! \xF0\x9F\x98\x8A");
}
if (strpos($message, "/setreminder") === 0)
{
    if(file_exists("./reminders/" . $chatId))
    {
        unlink("./reminders/" . $chatId);
    }
    $interval = substr($message, 13);
    $interval = intval($interval);
    if($interval > 0)
    {
        sendingMessage($botId, $chatId, "Your new reminder is set to: " . $interval . " Minutes \xF0\x9F\x91\x8D");
        file_put_contents("./reminders/" . $chatId, $interval); 
    }
    else
    {
        sendingMessage($botId, $chatId, "Sorry \xF0\x9F\x98\x94 I didn't get that. Please make sure you use the reminder command in the correct way: /setreminder 5  <-- This will set a 5 minute reminder.");
    }
}
if (str_contains($message, "/deletereminder"))
{
    if (!file_exists("./reminders/" . $chatId))
    {
        sendingMessage($botId, $chatId, "Error: No Reminder was set!");
    }
    else
    {
        unlink("./reminders/" . $chatId); //deletes file
        sendingMessage($botId, $chatId, "Your current reminder has been deleted. You won't get any new messages from now on \xF0\x9F\x98\xA2");
    }
}
?>