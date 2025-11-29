import os

while True:
    os.system('clear')
    figure = input("Scegliere la figura geometrica d cui calcolare l'area (rettangolo, triangolo, cerchio): ").strip().lower()
    if figure == "rettangolo":
        base = int(input("Inserire il valore della base del rettangolo: "))
        altezza = int(input("Inserire il valore dell'altezza del rettangolo: "))
        area = base * altezza
        print(f"L'area del rettangolo è: {area}")
        
        continue_choice = ''
        while continue_choice not in ['s', 'n']:
            continue_choice = input("Continuare? (s/n): ").strip().lower()
        if continue_choice == 'n':
            break
    elif figure == "triangolo":
        base = int(input("Inserire il valore della base del triangolo: "))
        altezza = int(input("Inserire il valore dell'altezza del triangolo: "))
        area = (base * altezza) / 2
        print(f"L'area del triangolo è: {area}")
        
        continue_choice = ''
        while continue_choice not in ['s', 'n']:
            continue_choice = input("Continuare? (s/n): ").strip().lower()
        if continue_choice == 'n':
            break
    elif figure == "cerchio":
        raggio = int(input("Inserire il valore del raggio del cerchio: "))
        area = 3.14 * (raggio ** 2)
        print(f"L'area del cerchio è: {area}")
        
        continue_choice = ''
        while continue_choice not in ['s', 'n']:
            continue_choice = input("Continuare? (s/n): ").strip().lower()
        if continue_choice == 'n':
            break
    else:
        print("Figura non riconosciuta. Si prega di scegliere tra rettangolo, triangolo o cerchio.")

