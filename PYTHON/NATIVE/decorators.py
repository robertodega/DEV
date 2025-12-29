
import os
os.system('cls' if os.name == 'nt' else 'clear')

#   ******************************* DECORATOR *******************************

def decorator(func):
    def wrapper():
        print("\nStarting execution ... ")
        func()
        print("Execution is ended ... \n")
    return wrapper()

def say_hello():
    print("Hello World!!!")

def greetings():
    print("Thank you all!")

decorator(say_hello)
decorator(greetings)

#   @decorator
#   def say_hello_with_decorator():
#       print("Hello World!!!")
#   
#   say_hello_with_decorator()
