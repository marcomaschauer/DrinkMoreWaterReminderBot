import os.path
from aiogram import Bot, Dispatcher, executor, types
from aiogram.contrib.fsm_storage.memory import MemoryStorage
from aiogram.dispatcher import FSMContext
from aiogram.dispatcher.filters.state import State, StatesGroup
import datetime
import json

bot = Bot(token='5333737571:AAGWsPKqvKQM8TnHIgvfvuknNDOCHyCTXOY')
storage = MemoryStorage() #set storage to save data in memory https://stackoverflow.com/questions/69846020/aiogram-waiting-user-reply
dp = Dispatcher(bot, storage=storage)

class Form(StatesGroup): #create Form with variable
    interval = State()
    remindtime = State()

@dp.message_handler(commands=['start', 'help'])
async def welcome(message: types.Message):
    await message.answer("Welcome! 😊")

@dp.message_handler(commands=['setreminder'])
async def setreminder(message: types.Message):
    await Form.interval.set() #set interval (waiting for user input)
    await message.answer("Give me an interval in Minutes please:")

@dp.message_handler(state=Form.interval) #Form for interval
async def process_name(message: types.Message, state: FSMContext):
    try:
        if(int(message.text) > 0):
            dictionary = {"reminder": message.text, "begintime": "08:00", "endtime": "20:00" }
            user_config = json.dumps(dictionary, indent=3)
            file_path = "./reminders/" + str(message.chat.id) + ".json"
            with open(file_path, "w") as file:
                file.write(user_config)
            await message.answer(f"Your new reminder is set to: {message.text} Minutes 👍")
            await state.finish() #close Form (deletes value from memory)
        else:
            await message.answer(f"Error: Interval must be greater than 0")
    except:
        await message.answer(f"Sorry, I diden't get that. 😬 Make sure you give me a whole Number like 60. This will set a reminder for 60 minutes.")

@dp.message_handler(commands=['deletereminder'])
async def welcome(message: types.Message):
    file_path = "./reminders/" + str(message.chat.id) + ".json"
    if (os.path.exists(file_path)):
        os.remove(file_path)
        await message.answer("Your current reminder has been deleted. You won't get any new messages from now on 😢")
    else:
        await message.answer("Error: No Reminder was set!")

@dp.message_handler(commands=['setremindtime'])
async def setreminder(message: types.Message):
    file_path = "./reminders/" + str(message.chat.id) + ".json"
    if (os.path.exists(file_path)):
        await Form.remindtime.set() #set remind time (waiting for user input)
        await message.answer("Give me a timespan like 08:00-20:00 :")
    else:
        await message.answer("Please set a reminder first!")

@dp.message_handler(state=Form.remindtime) #Form for Timespan
async def process_name(message: types.Message, state: FSMContext):
    try:
        timespan = message.text.split("-")
        begintime = datetime.datetime.strptime(timespan[0], "%H:%M").time()
        endtime = datetime.datetime.strptime(timespan[1], "%H:%M").time()
        file_path = "./reminders/" + str(message.chat.id) + ".json"
        with open(file_path, "r") as file:
            user_config = json.load(file)
            user_config["begintime"] = str(begintime)
            user_config["endtime"] = str(endtime)
            user_config = json.dumps(user_config, indent=3)
        with open(file_path, "w") as file:
            file.write(user_config)
        await message.answer(f"Your timespan in which we remind you is set between {begintime} and {endtime} 👍")
        await state.finish()
    except:
       await message.answer(f"Sorry, I diden't get that. 😬 Make sure you give me a timespan like 08:00-20:00 :")

executor.start_polling(dp)