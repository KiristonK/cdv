'''
def witaj(imie):
    print("Witaj ", end='')
    print(imie)
witaj(input())

def wyswietlWiek(wiek):
    print(f'Twoj wiek : {wiek}')
wyswietlWiek(input())
'''

def iloczyn(a, b):
    return a*b

print('Pdaj dwie liczby : ')
print(f'Iloczyn wynosi : {iloczyn(int(input()), int(input()))}')

def iloraz(a, b):
    return a/b

print('Pdaj dwie liczby : ')
print(f'Iloraz wynosi :{iloraz(int(input()),int(input()))}')
