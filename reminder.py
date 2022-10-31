import os, json, time, requests
from datetime import datetime, timedelta

def load_config():
    with open("./config.json", "r") as file:
        config = json.load(file)
    return config["token"]

def main():
    token=load_config()
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
            begin_time = datetime.strptime(user_config["begintime"], "%H:%M:%S").time()
            end_time = datetime.strptime(user_config["endtime"], "%H:%M:%S").time()
            if(time_in_range(begin_time, end_time, datetime.now().time())):
                since_time = datetime.now() - datetime.fromtimestamp(file_stats.st_ctime)
                if(int((since_time / timedelta(minutes=1)) % interval) == 0):
                    requests.get(url + f"&chat_id={chatID}")
        time.sleep(60)

def time_in_range(start, end, x):
    """Return true if x is in the range [start, end]"""
    if start <= end:
        return start <= x <= end
    else:
        return start <= x or x <= end

main()