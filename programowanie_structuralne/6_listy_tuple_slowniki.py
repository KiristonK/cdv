#listy
programowanie = ['Python', 'PHP', 'Java']
print(type(programowanie))
programowanie.append('C#')
print(programowanie)
ile = programowanie.count("PHP")
print(f'Php wystepuje {ile} razy')

#tuple
imiona = ('Julia', 'Anna', 'Tomek')
print(imiona)
print(type(imiona))
#w tuple nie da sie dodac elementy

firstName = imiona[0]
print(f'First name : {firstName}')

#słownik
osoba = {'imie':'Janusz',
         'nazwisko':'Nowak',
         'miasto':'Poznan',
         'wiek':20,
         'umowaOprace':True}
print(type(osoba))
print(osoba)
print(osoba['miasto'])
print(osoba.get('xyz','brak klucza'))
print(osoba.get('imie','brak klucza'))
print(osoba.keys())
