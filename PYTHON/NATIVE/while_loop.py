import os
os.system('clear')

status_codes = ["A1", "A2", "A3", "Err1", "A4", "A5"]
i = 0
err_char = "Err"
while i < len(status_codes):
    if err_char in status_codes[i]:
        print("Found Error: "+status_codes[i]+"")
        break
    print(status_codes[i])
    i += 1
print("End of Status codes")