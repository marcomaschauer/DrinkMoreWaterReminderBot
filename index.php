<?php
    //drinkmorewaterreminderbot
    //HTTP API TOKEN: 5130453203:AAHDdkQ3yAdp9mtahBX2qzC3zPZ_1q8jBL0
    //https://api.telegram.org/bot5130453203:AAHDdkQ3yAdp9mtahBX2qzC3zPZ_1q8jBL0/getUpdates
 
    function getChatID($bot_id)
    {    
        $url = 'https://api.telegram.org/bot' . $bot_id . '/getUpdates';
        $result = file_get_contents($url);
        //$result = file_get_contents('php://input');
        $result = json_decode($result, true);
        var_dump($result);
        return $result['result'][0]['message']['chat']['id'];
    }
    function sendingMessage($bot_id, $chat_id, $message)
    {
        $url = 'https://api.telegram.org/bot' . $bot_id . '/sendMessage?text='. $message . '&chat_id=' . $chat_id;
        file_get_contents($url);
    }




    $bot_id = "5130453203:AAHDdkQ3yAdp9mtahBX2qzC3zPZ_1q8jBL0";
    $chat_id = getChatID($bot_id);
    if (time_nanosleep(0, 5000000000) === true) 
    {
        sendingMessage($bot_id, $chat_id, 'In welchem Intervall willst du erinnert werden? Bitte in Minuten angeben!');
    }






?>