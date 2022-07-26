import os.path
from typing import List

from aiogram import Bot, Dispatcher, executor, types
from aiogram.contrib.fsm_storage.memory import MemoryStorage
from aiogram.dispatcher import FSMContext
from aiogram.dispatcher.filters.state import State, StatesGroup

bot = Bot(token='5333737571:AAGWsPKqvKQM8TnHIgvfvuknNDOCHyCTXOY')
storage = MemoryStorage() #set storage to save data in memory
dp = Dispatcher(bot, storage=storage)

class Form(StatesGroup): #create Form with variable
    interval = State()

@dp.message_handler(commands=['start', 'help'])
async def welcome(message: types.Message):
    await message.answer("Welcome! 😊")

@dp.message_handler(commands=['setreminder'])
async def setreminder(message: types.Message):
    await Form.interval.set() #set interval (waiting for user input)
    await message.answer("Give me an interval in Minutes please:")

@dp.message_handler(state=Form.interval) #Form
async def process_name(message: types.Message, state: FSMContext):
    file_path = "./reminders/" + str(message.chat.id)
    file = open(file_path, "w")
    file.write(f"{message.text}")
    file.close()
    await message.answer(f"Your new reminder is set to: {message.text} Minutes 👍")
    await state.finish() #close Form (deletes value from memory)

@dp.message_handler(commands=['deletereminder'])
async def welcome(message: types.Message):
    file_path = "./reminders/" + str(message.chat.id)
    if (os.path.exists(file_path)):
        os.remove(file_path)
        await message.answer("Your current reminder has been deleted. You won't get any new messages from now on 😢")
    else:
        await message.answer("Error: No Reminder was set!")




executor.start_polling(dp)