#print("CDV")
#print(2)

#potęga
#potega = 2 ** 10
#print(potega)

#pobieranie danuch z klawiatury
#imie = input();
#konkatenacja +
#print("Twoje imie podane z klawiatury : " + imie);

#nazwisko = input()
#print("Twoje imje : " + imie + ", Twoje nazwisko : " + nazwisko)

#dlugosc = len(nazwisko)
#print(type(dlugosc))
#print("Dlugosc nazwiska : ", dlugosc)

#dlugosc = str(dlugosc)

#print(type(dlugosc))
#print("Dlugosc nazwiska : " + dlugosc)
print("\nPodaj swoj wiek : ", end="")

wiek = input();
print("Twoj wiek jest : ", wiek, " lat")

nazwisko = 'Kowalski'
#imie_zmiennejNastepne_slowo_z_duzej to camelcase
pierwszyZnak = nazwisko[0]
#ostatniZnak = nazwisko[len(nazwisko)-1]
ostatniZnak = nazwisko[-1]
print(pierwszyZnak ,nazwisko[1], ostatniZnak)


#kowersja

x = "5"
print(type(x))
x = int(x)
print(type(x))

text = "Jan" * 2
print(type(text))

y = 6
print(type(y))
y = y / 2
print(type(y)) #float
print(y)

wiek = 21
print("Twoj wiek :", wiek)
wiek = str(wiek)
print("Twoj wiek : " + wiek)

nazwisko = "Jankowski"
print(nazwisko[0])
print(nazwisko[0 : 3])
print(nazwisko[-2])
print(nazwisko[-2 :])
print(nazwisko[: -2])
print(nazwisko[:-2:2]) #J(a)n(k)o(w)s(k)i
print(nazwisko[: : 2])
