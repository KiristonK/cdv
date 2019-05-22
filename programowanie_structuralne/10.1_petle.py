'''
#pętle zadania

'''
    #Podak wartość początkową i końcową, która będize
    #wypisana w porządku malejącym
'''

start = int(input("Podaj wartosc poczatkowa : "))
end = int(input("Podaj wartosc koncowa : "))

if end >= start:
    tmp = end
    end = start
    start = tmp

num = start;
while num != end - 1:
    print(num, end=" ")
    num -= 1

print()

for i in range(start,end -1,-1):
    print(i,end = " ")


print('\n\n')

'''
#*
#**
#***
#****
#*****
#******


a = int(input("Podaj rozmiar : "))

for i in range(0,a):
    for j in range(0,i+1):
        print('*', end="")
    print()

print()

a = int(input("Podaj ilosc wierszy : "))
sym = input("Znak : ")

for i in range(0,a+1):
    print(sym*i)

#import math
import os

#a = float(input("Podaj liczbe a : "))
#b = float(input("Podaj liczbe b : "))

#if (a+b) == 0:
#    print("Error : Dzielenie przez zero !")
#else:
#    print("Wartosc wyrazenia wynosi : ", (pow(a,2) + b)/(pow((a+b),2)))

'''
    Uzytkownik podaje z klawiatury haslo,
    jezeli poda haslo 'okon' to na ekranie wyswietliamy komunikat
    'Poprawne haslo'
    Uzytkownik ma na podanie hasla 3 proby
    Jezeli przekroczy ilosc prob to na ekranie wyswietli komunikat
    'Przekroczono limit podania hasla'
'''
tries = 0
while True:
    if input("Podaj haslo : ") == 'okon':
        print("Poprawne haslo")
        break
    else:
        tries += 1
        os.system('cls')
    if tries == 3:
        print("Przekroczono limit podania hasla")
        break

