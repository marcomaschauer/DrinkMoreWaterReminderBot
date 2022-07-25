from aiogram import Bot, Dispatcher, executor, types

bot = Bot(token='5130453203:AAHDdkQ3yAdp9mtahBX2qzC3zPZ_1q8jBL0')
dp = Dispatcher(bot)

@dp.message_handler(commands=['start', 'help'])
async def welcome(message: types.Message):
    await message.reply("Welcome! 😊")

@dp.message_handler()
async def echo(message: types.Message):
    await message.answer(message.text)

executor.start_polling(dp)