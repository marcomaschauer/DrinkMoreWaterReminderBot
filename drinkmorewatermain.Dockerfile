FROM python
WORKDIR /usr/drinkmorewaterbot
ENV TZ="Europe/Berlin"

RUN pip install --upgrade pip
RUN pip install aiogram
RUN pip install datetime
RUN pip install requests
RUN date

COPY ./main.py . 
COPY ./config.json .
COPY ./reminders ./reminders

CMD [ "python3", "/usr/drinkmorewaterbot/main.py" ]
