
import os
os.system('cls' if os.name == 'nt' else 'clear')

#   ******************************* OOP *******************************

print("\n\n***** OOP programming with Python *****\n\n")

class Employee:
    company = "Cap"                 #   class attribute

    def __init__(self, salary, name, bond, company=''):         #   CONSTRUCTOR
        self.salary = salary
        self.name = name
        self.bond = bond
        self.company = company

    def get_salary(self):       #   self is a reference to the object of the class
        return self.salary
    
    def get_info(self):
        print(f"Name of employee: {self.name}, Salary is {self.salary}, Company is {self.company}, Bond is {self.bond} years")


class Programmer(Employee):         #   INHERITANCE

    def __init__(self, salary, name, bond, company=''):
        super().__init__(salary, name, bond, company)

    def get_work_type(self):
        return "Code Development"
    
    def get_salary(self):
        #   return super().get_salary()
        return 48000

print(f"Class company attribute: {Employee.company}")

e1 = Employee(34000, "John Doe", 4, "Asus")
print(e1.get_salary())
e1.get_info()

e2 = Employee(45000, "John Doe", 3, "Testa")
e2.get_info()

#   print(dir(e1))      #   object introspection

prog = Programmer(34000, "John Doe", 4, "Asus")
wt = prog.get_work_type()
print(prog.name, wt, prog.get_salary())

print("\n\n*****************************************************\n\n")
