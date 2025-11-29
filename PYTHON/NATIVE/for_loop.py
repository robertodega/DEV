import os
os.system('clear')

n = int(input('Insert n value: '))

#   -------------------- Factorial --------------
fact = 1
for i in range(1, n+1):
    fact *= i
#   -------------------- Fibonacci --------------
a = 0
b = 1
for i in range(1, n+1):
    c = a + b
    a = b
    b = c

print("\tFactorial value of "+str(n)+":\t"+str(fact)+"")
print("\tFibonacci value of "+str(n)+":\t"+str(a)+"")

#   -------------------- Prime number --------------
num = int(input('\n\ninsert number to see if it is a prime number: '))
count = 0
for i in range(1, num+1):
    if num % i == 0:
        count += 1
if count == 2:
    is_prime = ""
    print(''+str(num)+' is PRIME')
else:
    print(''+str(num)+' is NOT PRIME')

finalNum = int(input('How much numbers among them to print prime? '))
print("\n\nall prime numbers from 1 to "+str(finalNum)+":\n\n")

for n in range(1, finalNum + 1):
    count = 0
    for i in range(1, n + 1):
        if not n % i:
            count += 1
    if count == 2:
        print(""+str(i)+"",", ", end='')
print()


