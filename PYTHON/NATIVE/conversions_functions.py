import os

while True:
    try:
        os.system('clear')
        inputValue = float(input("Insert your decimal value: "))
        conversion_group = {
            "binary": bin(int(inputValue))
            , "octal": oct(int(inputValue))
            , "hexadecimal": hex(int(inputValue))
        }
        for conv in conversion_group:
            print(f"\n\nthe {conv} value is: {conversion_group[conv]}")

        continue_str = ""
        while continue_str != 'y' and continue_str != 'n':
            continue_str = input("\n\nContinue? (y/n)").strip().lower()
            os.system('clear')
        if continue_str == 'n':
            break
    except:
        print('Invalid input, Please enter a numeric value')