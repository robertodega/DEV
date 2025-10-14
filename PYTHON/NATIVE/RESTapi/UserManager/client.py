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
