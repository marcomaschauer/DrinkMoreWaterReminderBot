from aiogram import Bot, Dispatcher, executor, types

bot = Bot(token='5333737571:AAGWsPKqvKQM8TnHIgvfvuknNDOCHyCTXOY')
dp = Dispatcher(bot)

@dp.message_handler(commands=['start', 'help'])
async def welcome(message: types.Message):
    await message.reply("Welcome! 😊")

@dp.message_handler(commands=['setreminder'])
async def welcome(message: types.Message):
    await message.reply("Welcome! 😊")

@dp.message_handler(commands=['deletereminder'])
async def welcome(message: types.Message):
    await message.reply("Welcome! 😊")

@dp.message_handler()
async def echo(message: types.Message):
    await message.answer(message.text)

executor.start_polling(dp)