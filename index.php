<?php
    //drinkmorewaterreminderbot
    //HTTP API TOKEN: 5130453203:AAHDdkQ3yAdp9mtahBX2qzC3zPZ_1q8jBL0
    //https://api.telegram.org/bot5130453203:AAHDdkQ3yAdp9mtahBX2qzC3zPZ_1q8jBL0/getUpdates
    //https://api.telegram.org/bot5130453203:AAHDdkQ3yAdp9mtahBX2qzC3zPZ_1q8jBL0/close

// Alle Reminder mit Intervall in eine Datei schreiben und einen CronJob konfigurieren der dann das Script ausführt um die Reminder zu senden
//Das Script hier legt nur die Dateien an und Löscht diese + User Interaktion

    function sendingMessage($bot_id, $chat_id, $message)
    {
        $url = 'https://api.telegram.org/bot' . $bot_id . '/sendMessage?text='. $message . '&chat_id=' . $chat_id;
        file_get_contents($url);
    }
    function setReminder($chatId, $interval)
    {
        file_put_contents($chatId, $interval);
    }
    function deleteReminder($chatId)
    {
        unlink($chatId);
    }

$botId = "5130453203:AAHDdkQ3yAdp9mtahBX2qzC3zPZ_1q8jBL0";
$update = json_decode(file_get_contents("php://input"), TRUE);
//file_put_contents("./log_".date("j.n.Y").".log", $update, FILE_APPEND);
$chatId = $update["message"]["chat"]["id"];
$message = $update["message"]["text"];
if (strpos($message, "/setreminder") === 0)
{
    $interval = substr($message, 13);
    sendingMessage($botId, $chatId, "Your new reminder is set to: " . $interval . " Minutes");
    setReminder($chatId, $interval);
    while(file_exists($chatId))
    {
        sleep($interval * 60);
        sendingMessage($botId, $chatId, "Drink Water!");
    }
}
if (strpos($message, "/deletereminder") === 0)
{
    if (file_exists($chatId))
    {
        sendingMessage($bot_id, $chatId, "Error: No Reminder was set.");
    }
    else
    {
        deleteReminder($chatId);
        sendingMessage($bot_id, $chatId, "Your current reminder has been deleted. You won't get any new messages from now on. ");
    }
}
?>