import os
os.system('clear')

items=[]
prices=[]

max_items_num=int(input('How much dishes in menu? '))

for i in range(1,max_items_num+1):
    item_name = input('dish number ' + str(i) + ' name: ')
    items.append(item_name)
    item_price = input('dish number ' + str(i) + ' price: ')
    prices.append(item_price)
    
menulist = []
max_row_length = 25
index = 0
for item in items:
    name_lenght = len(item)
    price_lenght = len(prices[index])
    dash_length = max_row_length - name_lenght - price_lenght - 2
    dash_item = '-' * dash_length
    menu_row = item + " " + dash_item + " " + prices[index]
    menulist.append(menu_row)
    index += 1

for row in menulist:
    print(row)
