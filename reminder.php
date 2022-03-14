<?php
    //drinkmorewaterreminderbot
    //HTTP API TOKEN: 5130453203:AAHDdkQ3yAdp9mtahBX2qzC3zPZ_1q8jBL0
    //https://api.telegram.org/bot5130453203:AAHDdkQ3yAdp9mtahBX2qzC3zPZ_1q8jBL0/getUpdates
    //https://api.telegram.org/bot5130453203:AAHDdkQ3yAdp9mtahBX2qzC3zPZ_1q8jBL0/close
    $message = "It's time for a drink! \xF0\x9F\x8D\xB9";
    $url = 'https://api.telegram.org/bot5130453203:AAHDdkQ3yAdp9mtahBX2qzC3zPZ_1q8jBL0/sendMessage?text=';
    $directory = "./reminders";

    //Ein Skript das jede Minute per Cron Job ausgeführt wird und alle Dateien im Ordner Checkt.
    //Wenn der Inhalt der Datei (Int) glatt durch die Zeit wie lange die Datei schon existiert teilbar ist, dann soll er eine Nachricht versenden 
    foreach(glob($directory.'/*') as $file)
    {
        $chatID = basename($file);
        $interval = file_get_contents($file);
        $filetime = filemtime($file);
        $currenttime = time();
        $sinceTime = floor(($currenttime - $filetime) / 60);
        //echo"Interval: " . $interval . ", Time difference: " . $sinceTime . " Minutes," . " Modulo: " . fmod($sinceTime, $interval);
        if(fmod($sinceTime, $interval) == 0.00)
        {
            file_get_contents($url . $message . '&chat_id=' . $chatID);
            //echo "   ,Succsess";
        }
    }
?>