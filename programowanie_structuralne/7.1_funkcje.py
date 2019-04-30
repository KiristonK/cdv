#przekazywanie argumentów przez referencję

def show(name):
    print(f'Przed modyfikacja : {name}')
    name[0] = 'Beata'
    name[1] = 'Barbara'
    name[2] = 'Bogdan'
    print(f'Po modyfikacji : {name}')
    print(f'Id obiektu show po modyfikacji objektu data : {id(name)}')

data = ['Anna', 'Agnieszka', 'Andrzej']

print(f'Przed wywolaniem funkcji : {data}')
print(f'Id obiektu show : {id(data)}')
show(data)

print(f'Zprawdzam po wywolaniu funkcji show : {data}')


############################## slownik #####################################


data1 = {
    0:'Andrzej',
    1:'Nowak'
}

print(f'\nID przed modyfikacja data1 : {id(data1)}')
show(data1)


############################ prekazywanie argumentów prze wartość ########################

print('\n\n')
def show1(city):
    print(f'Przed modyfikacja : {city}')
    city[0] = 'Beata'
    city[1] = 'Barbara'
    #city[2] = 'Bogdan'
    print(f'Po modyfikacji : {city}')
    print(f'Id obiektu show po modyfikacji objektu data : {id(city)}')

miasto = ['Poznan','Gniezno']
print(f'Przed wywolaniem funkcji : {miasto}')
print(f'Przed modyfikacja : {id(miasto)}')
show1(list(miasto))

print(f'Zprawdzam po wywolaniu funkcji show1 : {miasto}')

print('\n\n')

def show2(city):
    print(f'Przed modyfikacja : {city}')
    city[0] = 'Berlin'
    city[1] = 'Londyn'
    print(f'Po modyfikacji : {city}')
    print(f'Id obiektu show po modyfikacji objektu data : {id(city)}')

miasto1 = {
    0:'Gniezno',
    1:'Poznan'
}

print(f'Przed wywolaniem funkcji : {miasto1}')
print(f'Przed modyfikacja : {id(miasto1)}')
show1(list(miasto1))

print(f'Zprawdzam po wywolaniu funkcji show1 : {miasto1}');






