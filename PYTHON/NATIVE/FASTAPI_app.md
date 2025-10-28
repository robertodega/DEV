#   GESTIONE UTENTI CON FASTAPI

- python3 -m venv venv
- source venv/bin/activate (su Windows usa `venv\Scripts\activate`)

- sudo apt install python3-fastapi
- sudo apt install python3-uvicorn
- sudo apt install python3-requests

- nano server.py

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

- python3 -m uvicorn server:app --reload

- documentazione interattiva Swagger UI: http://127.0.0.1:8000/docs

- nano client.py

        import requests

        BASE_URL = "http://127.0.0.1:8000"

        def get_users():
            response = requests.get(f"{BASE_URL}/users")
            print("GET /users:", response.json())

        def create_user(user_id, name, email):
            user_data = {"id": user_id, "name": name, "email": email}
            response = requests.post(f"{BASE_URL}/users", json=user_data)
            print("POST /users:", response.json())

        def get_user(user_id):
            response = requests.get(f"{BASE_URL}/users/{user_id}")
            if response.status_code == 200:
                print(f"GET /users/{user_id}:", response.json())
            else:
                print(f"GET /users/{user_id} failed:", response.text)

        def update_user(user_id, new_name, new_email):
            updated_data = {"id": user_id, "name": new_name, "email": new_email}
            response = requests.put(f"{BASE_URL}/users/{user_id}", json=updated_data)
            print(f"PUT /users/{user_id}:", response.json())

        def delete_user(user_id):
            response = requests.delete(f"{BASE_URL}/users/{user_id}")
            print(f"DELETE /users/{user_id}:", response.text)

        if __name__ == "__main__":
            # Test delle API
            get_users()  # Lista utenti (vuota all'inizio)
            create_user(1, "Mario Rossi", "mario@example.com")  # Crea un utente
            get_user(1)  # Ottieni i dettagli dell'utente creato
            get_users() 
            update_user(1, "Mario Bianchi", "mario.bianchi@example.com")  # Modifica l'utente
            get_users() 
            delete_user(1)  # Elimina l'utente
            get_users()  # Controlla che la lista sia di nuovo vuota

- python3 client.py

