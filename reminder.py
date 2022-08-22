from importlib.metadata import requires
import os, json, time, requests
from datetime import datetime, timedelta

def main():
    token='5333737571:AAGWsPKqvKQM8TnHIgvfvuknNDOCHyCTXOY'
    message = "It's time for a drink! 🍹"
    url = f"https://api.telegram.org/bot{token}/sendMessage?text={message}"
    directory = os.path.relpath("reminders/")
    while (1):
        for file in os.listdir(directory):
            file_path = os.path.relpath("reminders/" + file)
            file_stats = os.stat(file_path)
            chatID = os.path.basename(file_path)
            file = open(file_path, "r")
            user_config = json.load(file)
            file.close
            interval = int(user_config["reminder"])
            begin_time = user_config["begintime"]
            end_time = user_config["endtime"]
            since_time = datetime.now() - datetime.fromtimestamp(file_stats.st_ctime)
            if(int((since_time / timedelta(minutes=1)) % interval) == 0):
                #send_message(chatID ,message)
                requests.get(url + f"&chat_id={chatID}")
        time.sleep(60)
main()