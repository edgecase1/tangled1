FROM python:3.8-slim-buster

#RUN apt-get update -y && apt-get install ping-utils -y

RUN pip3 install flask

WORKDIR /app
COPY api2.py /app/

EXPOSE 5555

ENV FLASK_APP=api2
CMD ["python3", "-m", "flask", "run", "--host=0.0.0.0", "--port=5555"]

