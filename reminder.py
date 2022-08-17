import os
from aiogram import Bot, Dispatcher
import datetime
import json

bot = Bot(token='5333737571:AAGWsPKqvKQM8TnHIgvfvuknNDOCHyCTXOY')
dp = Dispatcher(bot)

message = "It's time for a drink! \xF0\x9F\x8D\xB9"
directory = "./reminders/*"
for file in os.listdir (directory):
    file_stats = os.stat(file)
    chatID = os.path.basename(file)
    file = open(file, "r")
    user_config = json.load(file)
    file.close
    interval = user_config["reminder"]
    begin_time = user_config["begintime"]
    end_time = user_config["endtime"]
    since_time = (datetime().time() - datetime.datetime.fromtimestamp(file_stats.st_ctime).time()) /60  
    if(since_time > 0):
        if(since_time % interval == 0):
            message.answer(message)