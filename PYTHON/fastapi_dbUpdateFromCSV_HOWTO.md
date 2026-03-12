# filesystem construction

mkdir dbUpdateFromCSV \
&& cd dbUpdateFromCSV \
&& mkdir templates static static/css static/js \
&& touch .env const.py requirements.txt data.csv main.py dbmanager.py static/css/custom.css static/js/custom.js templates/base.html templates/index.html templates/upload.html

- nano .env

        DB_HOST=localhost
        DB_USER=root
        DB_PASSWORD=
        DB_NAME=utils

- nano const.py

        page_title="CSV Upload feature"

- nano requirements.txt

        uvicorn 
        pandas 
        mysql-connector-python 
        python-dotenv 
        sqlalchemy 
        python-multipart 
        jinja2

- nano data.csv

        id,name,age,city
        1,Mario,30,Roma
        2,Luigi,25,Milano

- nano dbmanager.py

        from sqlalchemy import create_engine, Column, Integer, String, Float
        from sqlalchemy.ext.declarative import declarative_base
        from sqlalchemy.orm import sessionmaker, Session
        from dotenv import load_dotenv
        import os

        load_dotenv()

        DB_HOST = os.getenv("DB_HOST")
        DB_USER = os.getenv("DB_USER")
        DB_PASSWORD = os.getenv("DB_PASSWORD")
        DB_NAME = os.getenv("DB_NAME")

        DATABASE_URL = f"mysql+mysqlconnector://{DB_USER}:{DB_PASSWORD}@{DB_HOST}/{DB_NAME}"
        engine = create_engine(DATABASE_URL)
        SessionLocal = sessionmaker(autocommit=False, autoflush=False, bind=engine)
        Base = declarative_base()

        class User(Base):
            __tablename__ = "testusers"
            id = Column(Integer, primary_key=True, index=True)
            name = Column(String(100))
            age = Column(Integer)
            city = Column(String(100))

        Base.metadata.create_all(bind=engine)

        def get_db():
            db = SessionLocal()
            try:
                yield db
            finally:
                db.close()

- nano main.py

        import pandas as pd
        from fastapi import FastAPI, Request, UploadFile, File, HTTPException, Depends
        from sqlalchemy.orm import sessionmaker, Session
        import io
        from dbmanager import engine, get_db
        from fastapi.responses import HTMLResponse
        from fastapi.templating import Jinja2Templates
        from fastapi.staticfiles import StaticFiles
        import const

        app = FastAPI()
        app.mount("/static", StaticFiles(directory="static"), name="static")
        templates = Jinja2Templates(directory="templates")

        @app.get("/", response_class=HTMLResponse)
        async def root(request: Request):

            context = {
                "request": request,
                "const": const,
            }

            return templates.TemplateResponse(
                "index.html", 
                context=context
            )

        @app.post("/upload-csv/")
        async def upload_csv(request: Request, file: UploadFile = File(...), db: Session = Depends(get_db)):

            if not file.filename.endswith(".csv"):
                raise HTTPException(status_code=400, detail="File non valido. Caricare solo CSV.")

            try:
                contents = await file.read()
                df = pd.read_csv(io.StringIO(contents.decode('utf-8')))

                df.to_sql(name='testusers', con=engine, if_exists='append', index=False)

                uploadResult="Dati inseriti con successo"
                result_style="success"

            except Exception as e:
                if "Duplicate entry" in str(e):
                    uploadResult="Dati già presenti nel database"
                    result_style="warning"
                else:
                    uploadResult="ERROR in inserimento dati: " + str(e)
                    result_style="error"

            context = {
                "request": request,
                "const": const,
                "uploadResult": uploadResult,
                "result_style": result_style,
                "filename": file.filename,
            }

            return templates.TemplateResponse(
                "upload.html", 
                context=context
            )

- nano templates/base.html

        <!DOCTYPE html>
        <html>
        <head>
            <title>FastAPI CSV Reader</title>

            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
            <script src="https://code.jquery.com/jquery-4.0.0.min.js" integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous"></script>

            <link href="{{ url_for('static', path='/css/custom.css') }}" rel="stylesheet">
        </head>
        <body>
            <div class="container-div">
                <h1>{{ page_title }}</h1>
                {% block content %}
                {% endblock %}
            </div>
        </body>
        </html>

        <link href="{{ url_for('static', path='/js/custom.js') }}" rel="stylesheet">

- nano templates/index.html

        {% extends "base.html" %}

        {% block content %}
            <ul>
                <li><a href="/docs" target="_blank">Swagger UI</a></li>
            </ul>
            <form action="/upload-csv/" method="post" enctype="multipart/form-data">
                <input type="file" name="file" accept=".csv" required>
                <button type="submit">Carica CSV</button>
            </form>
        {% endblock %}

- nano templates/upload.html

        {% extends "base.html" %}

        {% block content %}
            <ul>
                <li><a href="/" target="_blank">Home</a></li>
                <li><a href="/docs" target="_blank">Swagger UI</a></li>
            </ul>
            <div class="result-div">
                Result: <span class="result-span-{{ result_style }}">{{ uploadResult }}</span>
            </div>
        {% endblock %}

- nano static/css/custom.css

        body {
          background-color: wheat;
          font-family: "Trebuchet MS", "Lucida Sans Unicode", "Lucida Grande",
            "Lucida Sans", Arial, sans-serif;

          .container-div {
            padding: 1%;

            ul {
              display: flex;
              gap: 10px;

              li {
                list-style: none;
                margin: 20px;
              }
            }

            a {
              text-decoration: none;
              color: black;
              font-size: 20px;
            }
            a:hover {
              color: blue;
            }

            .result-div {
              .result-span-success {
                color: green;
                font-size: 24px;
                font-weight: bold;
              }
              .result-span-warning {
                color: orange;
                font-size: 24px;
                font-weight: bold;
              }
              .result-span-error {
                color: red;
                font-size: 24px;
                font-weight: bold;
              }
            }
          }
        }

- nano static/js/custom.js

# app run

- python3 -m venv venv
- source venv/Scripts/activate
- pip3 install -r requirements.txt
- uvicorn main:app --reload

# app folder removal

- cd ../ && rm -rf dbUpdateFromCSV && deactivate
