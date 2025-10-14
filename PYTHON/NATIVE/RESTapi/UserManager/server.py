from fastapi import FastAPI, HTTPException
from pydantic import BaseModel
from typing import List

app = FastAPI()

# Modello dati per un utente
class User(BaseModel):
    id: int
    name: str
    email: str

# Database simulato
users_db = []

# Endpoint per ottenere la lista degli utenti
@app.get("/users", response_model=List[User])
def get_users():
    return users_db

# Endpoint per ottenere un utente per ID
@app.get("/users/{user_id}", response_model=User)
def get_user(user_id: int):
    for user in users_db:
        if user.id == user_id:
            return user
    raise HTTPException(status_code=404, detail="User not found")

# Endpoint per creare un nuovo utente
@app.post("/users", response_model=User)
def create_user(user: User):
    users_db.append(user)
    return user

# Endpoint per aggiornare un utente
@app.put("/users/{user_id}", response_model=User)
def update_user(user_id: int, updated_user: User):
    for index, user in enumerate(users_db):
        if user.id == user_id:
            users_db[index] = updated_user
            return updated_user
    raise HTTPException(status_code=404, detail="User not found")

# Endpoint per eliminare un utente
@app.delete("/users/{user_id}")
def delete_user(user_id: int):
    for index, user in enumerate(users_db):
        if user.id == user_id:
            del users_db[index]
            return {"message": "User deleted successfully"}
    raise HTTPException(status_code=404, detail="User not found")




