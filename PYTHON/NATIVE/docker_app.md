
-   #   creazione progetto

mkdir PROJECTS/Python/APP/docker_example_app
cd PROJECTS/Python/APP/docker_example_app

-   #   utilizzo ambiente virtuale

python3 -m venv venv
source venv/bin/activate
sudo apt install python3-flask

-   #       costruzione files progetto

touch app.py
touch requirements.txt
touch Dockerfile

nano app.py

        from flask import Flask

        app = Flask(__name__)

        @app.route('/')
        def hello_world():
            return 'Hello, World!'

        if __name__ == '__main__':
            app.run(host='0.0.0.0', port=5000)

nano requirements.txt

        Flask
        werkzeug==0.16.1
        markupsafe==2.0.1

nano Dockerfile

        FROM python:3.9-slim
        WORKDIR /APP/docker_example_app
        COPY requirements.txt requirements.txt
        RUN pip install -r requirements.txt

        #   COPY venv venv
        COPY app.py app.py

        EXPOSE 5000

        CMD ["python", "app.py"]




-   #   costruzione da terminale dell'immagine docker

docker build -t docker_example_app .

-   #   esecuzione container

docker run -p 5000:5000 docker_example_app

-   #   accesso all'applicazione

http://localhost:5000
