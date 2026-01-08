
# project creation

- mkdir <PROJ_NAME>/
- cd <PROJ_NAME>/
- mkdir app
- touch requirements.txt .env .example app/database.py app/models.py app/schemas.py app/crud.py app/main.py Dockerfile Readme.md

# project files customization

- nano requirements.txt

        fastapi==0.95.2
        uvicorn[standard]==0.22.0
        SQLAlchemy==2.0.19
        pymysql==1.1.0
        python-dotenv==1.0.0

- nano .env.example

        # Copia questo file in .env e modifica i valori
        DATABASE_URL=mysql+pymysql://dbuser:dbpassword@localhost:3306/dbname

- nano .env

        DATABASE_URL=mysql+pymysql://root:''@localhost:3306/utils

- nano app/database.py

        import os
        from sqlalchemy import create_engine
        from sqlalchemy.orm import sessionmaker, declarative_base
        from dotenv import load_dotenv

        load_dotenv()  # carica .env in sviluppo

        DATABASE_URL = os.getenv("DATABASE_URL")
        if not DATABASE_URL:
            raise RuntimeError(
                "Imposta DATABASE_URL nel file .env o nelle variabili d'ambiente"
            )

        # Engine sincrono
        engine = create_engine(DATABASE_URL, pool_pre_ping=True)

        # Session per dependency injection
        SessionLocal = sessionmaker(autocommit=False, autoflush=False, bind=engine)

        Base = declarative_base()

- nano app/models.py

        from sqlalchemy import Column, Integer, String, Float
        from .database import Base


        class Product(Base):
            __tablename__ = "utils"

            id = Column(Integer, primary_key=True, index=True)
            subject = Column(String(50), nullable=False)
            username = Column(String(100), nullable=False)
            password = Column(String(100), nullable=False)
            note = Column(String(1024))

- nano app/schemas.py

        from pydantic import BaseModel
        from typing import Optional


        class UtilBase(BaseModel):

            subject: str
            username: str
            password: str
            note: Optional[str] = None


        class Util(UtilBase):
            id: int

            class Config:
                orm_mode = True

- nano app/crud.py

        from sqlalchemy.orm import Session
        from . import models


        def get_utils(db: Session, skip: int = 0, limit: int = 100):
            return db.query(models.Util).offset(skip).limit(limit).all()


        def get_util(db: Session, util_id: int):
            return db.query(models.Util).filter(models.Util.id == util_id).first()

- nano app/mainpy

        from fastapi import FastAPI, Depends, HTTPException
        from sqlalchemy.orm import Session
        from sqlalchemy import text
        from typing import List
        from . import models, crud, schemas
        from .database import SessionLocal, engine

        # ATTENZIONE: non chiamo Base.metadata.create_all() qui di default.
        # Se vuoi creare la tabella automaticamente (solo in dev), decommenta la riga sotto:
        # models.Base.metadata.create_all(bind=engine)

        app = FastAPI(title="Esempio FastAPI + MySQL")


        # Dependency per ottenere la sessione DB
        def get_db():
            db = SessionLocal()
            try:
                yield db
            finally:
                db.close()


        @app.get("/utils", response_model=List[schemas.Util])
        def read_utils(skip: int = 0, limit: int = 100, db: Session = Depends(get_db)):
            utils = crud.get_utils(db, skip=skip, limit=limit)
            return utils


        @app.get("/utils/{util_id}", response_model=schemas.Util)
        def read_util(util_id: int, db: Session = Depends(get_db)):
            util = crud.get_util(db, util_id=util_id)
            if not util:
                raise HTTPException(status_code=404, detail="Util not found")
            return util

        @app.get("/raw/{table}")
        def raw_table(table: str, db: Session = Depends(get_db), limit: int = 100):
            # Esegue una query SELECT * su una tabella specificata. ATTENZIONE: semplice e non pensato per produzione.
            # Sanitizza il nome tabella limitatamente: consente solo lettere, numeri e underscore.
            import re

            if not re.fullmatch(r"[A-Za-z0-9_]+", table):
                raise HTTPException(status_code=400, detail="Nome tabella non valido")
            sql = text(f"SELECT * FROM `{table}` LIMIT :limit")
            result = db.execute(sql, {"limit": limit})
            rows = [dict(r._mapping) for r in result.fetchall()]
            return {"table": table, "rows": rows}

- nano Dockerfile

        FROM python:3.11-slim

        WORKDIR /app

        COPY requirements.txt .
        RUN pip install --no-cache-dir -r requirements.txt

        COPY . .

        ENV PYTHONUNBUFFERED=1

        CMD ["uvicorn", "app.main:app", "--host", "0.0.0.0", "--port", "80"]

- python3 -m venv venv
- source venv/bin/activate
- pip install -r requirements.txt

- uvicorn app.main:app --reload