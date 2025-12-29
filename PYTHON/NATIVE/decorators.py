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

#   decorator with argument
def repeat(n):
    def decorator(func):
        def wrapper(argument):
            for i in range(n):
                func(argument)
        return wrapper
    return decorator

@repeat(8)
def say_hello(argument):
    print(f"Hello {argument} !")

say_hello("Roby")
