FROM python:3.9
WORKDIR /usr/drinkmorewaterbot
ENV TZ="Europe/Berlin"

COPY ./requirements.txt .

RUN pip install --upgrade pip
RUN pip install -r requirements.txt
RUN date

COPY ./main.py . 
COPY ./reminder.py . 
COPY ./config.json .
COPY ./reminders ./reminders

CMD [ "python3", "main.py" ]
