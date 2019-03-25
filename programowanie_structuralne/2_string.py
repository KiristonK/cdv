text = "Anna, paweł, JulIA"

lista = text.split(", ")
print(text)
print(lista)
print(type(lista))

imie1 = lista[0]
print("Twoje imię:", imie1)

imieDuze = imie1.upper();
print(imie1)
print(imieDuze)

imieMale = imie1.lower();
print(imieMale)

#sprawdzanie zawartości

print("\nPodaj swoje nazwisko ", end="")
nazwisko = input()
zawartosc = nazwisko.isalpha()
print(zawartosc)

#sprawdzic dlaczego przy liczbach jest False

nazwisko = ""
print(nazwisko.isalpha())

text1 = "\nJulia\n"
text2 = "Nowak"

text1 = text1.rstrip()
print(text1 + " " + text2)

#wyswietlanie lancucha znakow
#all python versions

text = "%s, Java i %s" % ("PHP", "Python")

print(text)

#>python 2.6

text = "{1}, Java i {0}".format("PHP", "Python")


#help(text.replace)

new = text.replace("PHP", "C#")
print(new)


#wypisanie danych

rok = 2019
misianc = "marzec"
dzien = 25

print("\nData : ", end="")
print(dzien, misianc, rok)

print("\nData : ", end="")
print(dzien, misianc, rok, sep="-")
























print()
