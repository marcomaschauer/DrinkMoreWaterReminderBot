FROM python

RUN pip install --upgrade pip
RUN pip install aiogram
RUN pip install datetime
RUN pip install requests

COPY ./ ./ 

ENTRYPOINT [ "python3" ]

CMD ["reminder.py"]