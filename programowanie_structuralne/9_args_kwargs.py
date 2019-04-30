def wyswietl(num1,num2):
    print(f'Liczba 1 : {num1}')
    print(f'Liczba 2 : {num2}')

wyswietl(3,4)

########################### *args ###########################

def wyswietlArgs(num1, *args):
    print(f'Element 1 : {num1}')
    for i in args:
        print(f'Element next: {i}')

wyswietlArgs(5,1,6,2)



###############################################################

imiona = ['Anna','Julia','Krzystof','Jan']

wyswietlArgs(imiona)
wyswietlArgs(*imiona)

###############################################################

import os
os.system('pause')
os.system('cls')

###################### **kwargs ###############################

def pracownik(**kwargs):
    for key, val in kwargs.items():
        print(f'Klucz : {key} : {val}')
pracownik1 = {
    'imie':'Jan',
    'nazwisko':'Nowak',
    'wiek':21,
    'miasto':'Poznan',
    'umowaOprace':True
}

pracownik(**pracownik1)



