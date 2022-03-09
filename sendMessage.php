<?php
    //drinkmorewaterreminderbot
    //HTTP API TOKEN: 5130453203:AAHDdkQ3yAdp9mtahBX2qzC3zPZ_1q8jBL0
    //https://api.telegram.org/bot5130453203:AAHDdkQ3yAdp9mtahBX2qzC3zPZ_1q8jBL0/getUpdates
    //https://api.telegram.org/bot5130453203:AAHDdkQ3yAdp9mtahBX2qzC3zPZ_1q8jBL0/close
    $message = "It's time for a drink!";
    $chat_id = //get the id from cron job or file
    $url = 'https://api.telegram.org/bot5130453203:AAHDdkQ3yAdp9mtahBX2qzC3zPZ_1q8jBL0' . '/sendMessage?text='. $message . '&chat_id=' . $chat_id;
    file_get_contents($url);


    //Ein Skript das jede Minute per Cron Job ausgeführt wird und alle Dateien im Ordner Checkt.
    //Wenn der Inhalt der Datei (Int) glatt durch die Zeit wie lange die Datei schon existiert teilbar ist, dann soll er eine Nachricht versenden 
?>