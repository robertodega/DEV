#   filesystem construction
mkdir dbManager \
&& cd dbManager \
&& mkdir static templates static/css static/js static/img \
&& touch .env database.py config.py main.py const.py static/css/bootstrap.css static/css/custom.css static/js/bootstrap.js static/js/jquery.js static/js/custom.js templates/base.html templates/index.html templates/users.html

- nano static/css/bootstrap.css

        content from CSS bootstrap cdn link ( https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css )

- nano static/js/bootstrap.js

        content from JS ootstrap cdn link ( https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js )

- nano static/js/jquery.js

        content from JS jquery cdn link ( https://code.jquery.com/jquery-4.0.0.min.js )

- nano .env

        DB_USER=root
        DB_PASSWORD=
        DB_HOST=localhost
        DB_PORT=3306
        DB_NAME=utils

- nano config.php

        from pydantic_settings import BaseSettings, SettingsConfigDict

        class Settings(BaseSettings):
            DB_USER: str
            DB_PASSWORD: str
            DB_HOST: str
            DB_PORT: int
            DB_NAME: str

            @property
            def DATABASE_URL(self):
                return f"mysql+pymysql://{self.DB_USER}:{self.DB_PASSWORD}@{self.DB_HOST}:{self.DB_PORT}/{self.DB_NAME}"

            model_config = SettingsConfigDict(env_file=".env")

        settings = Settings()

- nano database.py

        from sqlalchemy import create_engine
        from sqlalchemy.ext.declarative import declarative_base
        from sqlalchemy.orm import sessionmaker
        from config import settings

        engine = create_engine(settings.DATABASE_URL)
        SessionLocal = sessionmaker(autocommit=False, autoflush=False, bind=engine)
        Base = declarative_base()

        def get_db():
            db = SessionLocal()
            try:
                yield db
            finally:
                db.close()

- nano const.py

        website_title = "FastApi dbManager"
        rootpath = "./"

- nano main.py

        from fastapi import FastAPI, Depends, Request, Form, HTTPException
        from sqlalchemy.orm import Session, sessionmaker
        from sqlalchemy import Column, Integer, String, create_engine
        from sqlalchemy.ext.declarative import declarative_base
        from database import Base, engine, get_db

        from fastapi.responses import HTMLResponse
        from fastapi.templating import Jinja2Templates
        from fastapi.staticfiles import StaticFiles
        import const

        class Users(Base):
            __tablename__ = "users"
            id = Column(Integer, primary_key=True, index=True)
            user = Column(String(100))
            pwd = Column(String(250))
            note = Column(String(250))

        app = FastAPI()
        app.mount("/static", StaticFiles(directory="static"), name="static")
        templates = Jinja2Templates(directory="templates")

        @app.get("/", response_class=HTMLResponse)
        async def root(request: Request):

            context_data = {
                "const": const
            }
            
            return templates.TemplateResponse(
                request=request, 
                name="index.html", 
                context={"request": request, **context_data}
            )

        @app.get("/users", response_class=HTMLResponse)
        def read_users_html(request: Request, db: Session = Depends(get_db)):

            username = request.query_params.get("username") if "username" in request.query_params else None
            
            if username:
                user = db.query(Users).filter(Users.user == username).first()
                if not user:
                    raise HTTPException(status_code=404, detail="User not found")
                users = [user]
            
            else:
                users = db.query(Users).all()

            context_data = {
                "const": const,
                "utenti_db":users,
            }
            
            return templates.TemplateResponse(
                request=request, 
                name="users.html", 
                context={"request": request, **context_data}
            )

- nano templates/base.html

        <!DOCTYPE html>
        <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">

                <link rel="stylesheet" href="{{ url_for('static', path='css/bootstrap.css') }}">
                <script src="{{ url_for('static', path='js/jquery.js') }}"></script>
                <script src="{{ url_for('static', path='js/bootstrap.js') }}"></script>
                
                <link rel="stylesheet" href="{{ url_for('static', path='css/custom.css') }}">
                <script src="{{ url_for('static', path='js/custom.js') }}"></script>

                <title>{{ const.website_title }}</title>
            </head>

            <body>
                <div class="headerDiv">
                    <div class="headerBlockDiv">
                        <div class="headerTitleDiv" id="headerPathDiv">
                            <a href="./">{{ const.website_title }}</a>
                        </div>
                    </div>
                </div>
                <div class="contentDiv">
                    {% block content %} {% endblock %}
                </div>
            </body>
        </html>

- nano templates/index.html

        {% extends "base.html" %}

        {% block content %}
        <div class="content-container-div">
            This is the content of index.html
            <ul>
                <li>
                    <a href="/users" target="_self">Users</a>
                </li>
                <form action="/users" method="get">
                    <input type="text" name="username" placeholder="username">
                    <button type="submit">Get User</button>
                </form>
            </ul>
        </div>
        {% endblock %}

- nano templates/users.html

        {% extends "base.html" %}

        {% block content %}
        <div class="content-container-div">

            <table border="1">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Pwd</th>
                        <th>Note</th>
                    </tr>
                </thead>
                <tbody>
                    {% for user in utenti_db %}
                    <tr>
                        <td>{{ user.user }}</td>
                        <td>{{ user.pwd }}</td>
                        <td>{{ user.note }}</td>
                    </tr>
                    {% endfor %}
                </tbody>
            </table>
            
        </div>
        {% endblock %}

- nano static/css/custom.css

        body{
            background-color: antiquewhite;
            padding: 2%;

            .headerDiv{
                background-color: lightgrey;
                padding: 1%;
                text-align: center;
                font-weight: bold;
                font-size: 2rem;
            }

            .contentDiv{
                background-color: whitesmoke;
                padding: 1%;
                margin-top: 1%;
            }
        }

#   app run
- python3 -m venv dbmanagerEnv
- Windows:
    -   source dbmanagerEnv/Scripts/activate
- Linux:
    -   dbmanagerEnv/bin/activate

- pip3 install fastapi uvicorn jinja2 requests python-multipart sqlalchemy pymysql pydantic-settings

- uvicorn main:app --reload
- http://127.0.0.1:8000             #   Main App
- http://127.0.0.1:8000/docs        #   Swagger interface

- cd .. && rm -rf dbManager && clear && ls -la
