
import os
os.system('cls')

#   ******************************* LISTS *******************************

print("\n\n*** LISTS ***")
list_1 = [54, 23, 64, 93, 32]
list_2 = [29, "Hello", True, 3.8]

print(f"List 1: {list_1}")
print(f"List 2: {list_2}")
print(f"List 1[0]: {list_1[0]}")
print(list_1[2:4])
#   print(list_1[10])                   #   IndexError: list index out of range

#   list methods
list_1.append(123)
print(f"list_1 after appending 123: {list_1}")
last_insertion = list_1.pop()
print(f"list_1 after pop(): {list_1} - last_insertion: {last_insertion}")

list_1.extend(list_2)
print(f"list_1 after extend list_2: {list_1}")

list_1.insert(2, 812)
print(f"list_1 after insert 2, 812: {list_1}")

#   table = []
#   for i in range (1, 11):
#       table.append(5*i)
table = [5*i for i in range(1, 11)]             #   use of List comprehension
print(table)

#   ******************************* TUPLES *******************************

print("\n\n*** TUPLES (immutable lists) ***")
tuple_1 = (1, 2, 3, 4)
tuple_single_element = (1, )
print(f"tuple_1: {tuple_1}")
print(f"tuple_single_element: {tuple_single_element }")
a, b, c, d = tuple_1
print(f"unpacking of tuple_1: {a},{b},{c},{d}")
print(f"index of '3' in tuple_1: {tuple_1.index(3)}")

#   ******************************* SETS *******************************

print("\n\n*** SETS ( collection with no duplicates ) ***")
set_1 = {1, 2, 3, 4, 5}
set_2 = {3, 4, 5, 6, 7, 8, 9 ,10}

print(set_1, type(set_1))
#   print(set_1[1])                     #   TypeError: 'set' object is not subscriptable
set_1.add(23)
print(f"set_1 after adding 23: {set_1}")

set_1.remove(3)
print(f"set_1 after removing 3: {set_1}")

#   set_1.remove(35)
#   print(f"set_1 after removing 35 (NOT PRESENT): {set_1}")        #   KeyError: 35

set_1.discard(35)
print(f"set_1 after discard 35 (NOT PRESENT): {set_1}")         #   remove IF PRESENT without trowing errors

set_union = set_1.union(set_2)
print(f"set_union: {set_union}")

set_intesect = set_1.intersection(set_2)
print(f"set_intesect: {set_intesect}")

#   ******************************* DICTIONARY *******************************

print("\n\n*** DICTIONARY ( list of key => value pairs ) ***")
marks = {"roby": 60, "gio": 70, "gia": 90}
print(marks, type(marks))
print(f"marks[\"roby\"]: {marks['roby']}")
print(f"Keys of marks: {marks.keys()}")
print(f"Values of marks: {marks.values()}")
marks.clear()
print(f"marks after clear: {marks}")

#   dict comprehension
table_of_5 = {i: 5*i for i in range(1, 11)}
print(f"Dictionary comprehension: {table_of_5}")

#   **************************************************************************
print("\n\n")
