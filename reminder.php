<?php
    //drinkmorewaterreminderbot
    //HTTP API TOKEN: 5130453203:AAHDdkQ3yAdp9mtahBX2qzC3zPZ_1q8jBL0
    //https://api.telegram.org/bot5130453203:AAHDdkQ3yAdp9mtahBX2qzC3zPZ_1q8jBL0/
    $message = "It's time for a drink! \xF0\x9F\x8D\xB9";
    $url = 'https://api.telegram.org/bot5130453203:AAHDdkQ3yAdp9mtahBX2qzC3zPZ_1q8jBL0/sendMessage?text=';
    $directory = "./reminders/*";
    foreach(glob($directory) as $file)
    {
        $chatID = basename($file);
        $interval = file_get_contents($file);
        $sinceTime = floor((time() - filemtime($file)) / 60);
        //echo"Interval: " . $interval . ", Time difference: " . $sinceTime . " Minutes," . " Modulo: " . fmod($sinceTime, $interval);
        if(fmod($sinceTime, $interval) == 0.00)
        {
            file_get_contents($url . $message . '&chat_id=' . $chatID);
        }
    }
?>