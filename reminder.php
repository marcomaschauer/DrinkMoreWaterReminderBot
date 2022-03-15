<?php
    include("./scripts/conf.php");
    $message = "It's time for a drink! \xF0\x9F\x8D\xB9";
    $url = "https://api.telegram.org/bot" . $botId . "/sendMessage?text=";
    $directory = "./reminders/*";
    foreach(glob($directory) as $file)
    {
        $chatID = basename($file);
        $interval = file_get_contents($file);
        $sinceTime = floor((time() - filemtime($file)) / 60);
        //echo"Interval: " . $interval . ", Time difference: " . $sinceTime . " Minutes," . " Modulo: " . fmod($sinceTime, $interval);
        //file_put_contents("./log.txt", "Interval: " . $interval . ", Time difference: " . $sinceTime . " Minutes," . " Modulo: " . fmod($sinceTime, $interval));
        if(fmod($sinceTime, $interval) == 0.00)
        {
            file_get_contents($url . $message . '&chat_id=' . $chatID);
        }
    }
?>