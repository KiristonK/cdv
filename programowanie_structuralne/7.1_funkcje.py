#przekazywanie argumentów przez referencję

def show(name):
    print(f'Przed modyfikacja : {name}')
    name[0] = 'Beata'
    name[1] = 'Barbara'
    name[2] = 'Bogdan'
    print(f'Po modyfikacji : {name}')

data = ['Anna', 'Agnieszka', 'Andrzej']

show(data)
