FROM python

RUN pip install --upgrade pip
RUN pip install aiogram

COPY ./ ./ 

ENTRYPOINT [ "/bin/bash", "-l", "-c" ]

CMD ["python3", "./main.py"]