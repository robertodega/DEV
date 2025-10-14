
#   Docker service run

    sudo systemctl start docker

#   Docker service restart

    sudo systemctl restart docker

#   Docker status check

    sudo systemctl status docker

#   Project creation ( Python )

    mkdir <PATH_TO_APP>/<IMAGE_NAME>
    cd <PATH_TO_APP>/<IMAGE_NAME>
    python3 -m venv venv

#   Project activation

    source venv/bin/activate
    touch app.py Dockerfile docker-compose.yml requirements.txt

    nano app.py

        from flask import Flask

        app = Flask(__name__)

        @app.route("/")
        def home():
            return "Docker container is running!"

        if __name__ == "__main__":
            app.run(host="0.0.0.0", port=8080)

    nano Dockerfile

        # Usa un'immagine base di Python
        FROM python:3.9-slim

        # Imposta la directory di lavoro all'interno del container
        WORKDIR /app

        # Copia i file del progetto nella directory di lavoro
        COPY . /app

        # Installa le dipendenze
        RUN pip install --no-cache-dir -r requirements.txt

        # Espone la porta 8080
        EXPOSE 8080

        # Comando di avvio dell'app
        CMD ["python", "app.py"]

    nano requirements.txt

        flask==2.3.2

    nano docker-compose.yml     #   per utilizzo di database

        version: "3.9"
        services:
        app:
            build:
            context: .
            ports:
            - "8080:8080"
            volumes:
            - .:/app

#   Docker image construction

    docker build -t <IMAGE_NAME_LOWERCASE> .

#   Container run

    docker run -p 8080:8080 <IMAGE_NAME>
    docker-compose up                       #   if using Docker Compose

#   Container access

    docker exec -it <IMAGE_NAME> bash

#   Image save

    docker tag nome-immagine username/nome-immagine

#   Image upload

    docker push username/nome-immagine

#   Application Access

    http://localhost:8080

