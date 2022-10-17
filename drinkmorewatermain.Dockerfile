FROM python
WORKDIR /usr/drinkmorewaterbot
ENV TZ="Europe/Berlin"

RUN pip install --upgrade pip
RUN pip install aiogram
RUN pip install datetime
RUN pip install requests
RUN date

COPY ./main.py ./ 
COPY ./config.json ./
COPY ./reminders ./

ENTRYPOINT [ "python3" ]

CMD ["main.py"]
