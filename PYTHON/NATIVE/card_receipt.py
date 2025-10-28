import os
os.system('clear')

cardN = input('Insert car number: ')

#  white space removal and split into chunks of 4
cardNlist = []
index = 0
if " " in cardN:
    cardN = cardN.replace(" ", "")
for i in range (len(cardN)):
    cardNlist.append(cardN[index:index+4])
    index += 4

#   card receipt generation with replace method
cardNreceipt = ""
for i in cardNlist:
    cardNreceipt += i + " "

for i in range(3):
    for j in range(4):
        cardNreceipt = cardNreceipt.replace(cardNlist[i], "XXXX")
    cardNreceipt += " "
print("Your card receipt number is: " + cardNreceipt)

#   card receipt generation with last digit paste  method
last_digit = cardNreceipt[15:]
new_Card_receipt = ""
for i in range(3):
    for j in range(4):
        new_Card_receipt += "X"
    new_Card_receipt += " "
new_Card_receipt += last_digit
print("Your card receipt number is: " + new_Card_receipt)