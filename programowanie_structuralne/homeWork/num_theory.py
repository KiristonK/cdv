import time
def exp1(a, b):
	result = int(1)
	while b>0:
		result*=a
		b-=1
	return result

def exp2(a,b):
	if b==1:
		return a
	if b==2:
		return a*a
	if b%2==0:
		return exp2(exp2(a,b/2),2)
	else:
		return a*exp2(exp2(a,(b-1)/2),2)

def exp3(a,b):
	result = int(1)
	if b==2:
		return a*a
	if b==1:
		return a
	if b%2==1:
		return a*exp3(a,b-1)
	else:
		result = exp3(a,b/2)
		return result*result

def exp4(a,b):
	result = int(1)
	while b:
		if b%2==1:
			result*=a
		b = int(b/2)
		a*=a
	return result

def exp5(a,b):
	result = int(1)
	while b:
		if b&1:
			result*=a
		b>>=1
		a*=a
	return result

a = int(input("Podaj liczbę do potęgowania : "))
b = int(input("Podaj liczbę potęgę : "))

print("Metoda 1:\n",exp1(a,b))
print("Metoda 2:\n",exp2(a,b))
print("Metoda 3:\n",exp3(a,b))
print("Metoda 4:\n",exp4(a,b))
print("Metoda 5:\n",exp5(a,b))


print("Test na szybkość :")
b = int(50)
for i in range(1,6):
	print("Metoda ", i, "(1 - 1000000) : ", end="")
	start_time = time.time()
	for j in range(1,1000000):
		if i==1:
			exp1(int(j),b)
		if i==2:
			exp2(int(j),b)
		if i==3:
			exp3(int(j),b)
		if i==4:
			exp4(int(j),b)
		if i==5:
			exp5(int(j),b)
	print(time.time()-start_time)

