#programowanie = [listy] (tuple) {słowniki}


programowanie = ['Python', 'C#', 'JS', 'PHP', 'Java']
print(programowanie)
print(type(programowanie))

first = programowanie[0]
print(f'Pierwszy język progrramowania w liscie : {first}')

last = programowanie[-1]
print(f'Ostatni język progrramowania w liscie : {last}')

threeElements = programowanie[0:3]
print(f'Trzy języka progrramowania w liscie : {threeElements}')

#Dodanie nowego elementu na koncu listy

programowanie.append('Ruby')
print(programowanie)

#zlicznie elementów w liście

ile = programowanie.count('Python')
programowanie.append('Python')
ile = programowanie.count('Python')
print(ile)

iloscElementow = len(programowanie)
print('\nIlosc wszystkich elementow w liscie :', end=" ")
print(iloscElementow)

#palączenie listy
print(programowanie)
inneJezyki = ['C', 'C++']
programowanie.extend(inneJezyki)
print(programowanie)
print(len(programowanie))

#wycyszczenie listy

nowa = programowanie
print(id(nowa))
print(id(programowanie))
print(nowa)
nowa.append('GO')
print(nowa)
print(programowanie)
nowa.clear()
print(nowa)
print(programowanie)
