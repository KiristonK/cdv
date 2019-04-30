#zasieg zmiennych, zmienne localne i globalne

#precyzja liczby (zaokraglenie do 3 mi3jsc po przecinku)

x = "{0:.3f}".format(5)

print(x)


def plnToChf(value):
    kursChf = 3.7536
    iloscChf = value / kursChf
    iloscChf = "{0:.0f}".format(iloscChf)
    print(f'Ilosc Chf : {iloscChf}')


plnToChf(100)


def plnToEu(value):
    kursEu = 4.2875
    iloscEu = "{0:.0f}".format(value / kursEu)
    print(f'Ilosc Euro : {iloscEu}')

plnToEu(float(input("Podaj ilosc PLN : ")))


## zmienna globalna ##

kursUSD = 3.8281
print(f'Id USD: {id(kursUSD)}')

def plnToUSD(value):
   # kursUSD = 3.8281
    iloscUSD = "{0:.0f}".format(value / kursUSD)
    return iloscUSD

print(f'\nKurs USD wynosi : {kursUSD}')
print("PLN =",plnToUSD(float(input("Ilosc "))),"USD", end='')


varGlobal = 10
print(f'\n\nWartosc zmiennej globalnej : {varGlobal}')
print(f'Id varGlobal : {id(varGlobal)}')


def spr():
    global varGlobal
    varGlobal = 20
    print(f'\n\nWartosc zmiennej globalnej in func : {varGlobal}')
    print(f'Id varGlobal in func : {id(varGlobal)}')

spr()
print(f'\n\nWartosc zmiennej globalnej out func : {varGlobal}')
print(f'Id varGlobal out func : {id(varGlobal)}')

