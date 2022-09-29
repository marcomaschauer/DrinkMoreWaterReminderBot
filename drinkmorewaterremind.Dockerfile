FROM python
WORKDIR /usr/drinkmorewaterbot

RUN pip install --upgrade pip
RUN pip install aiogram
RUN pip install datetime
RUN pip install requests

COPY ./reminder.py ./ 
COPY ./config.json ./ 
COPY ./reminders ./ 

ENTRYPOINT [ "python3" ]

CMD ["reminder.py"]
