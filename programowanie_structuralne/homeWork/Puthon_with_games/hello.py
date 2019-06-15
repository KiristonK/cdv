import random

guessesTaken = 0
number = random.randint(1,20)
myName = input('Hello, what\'s your name ?\n')
print('I\'m glad to see you,', myName)
print('Try to guess what number from 1 to 20 is on my mind ?')

for guessesTaken in range(6):
    print('Try to guess.')
    guess = int(input())

    if guess < number:
        print('Your number is too small.')

    if guess > number:
        print('Your number is too high.')

    if guess == number:
        guessesTaken = str(guessesTaken + 1)
        print('Gongratulations ! \n You guessed my number in ' + guessesTaken + ' tries!')
        break
if guess != number:
    number = str(number)
    print('Sorry but on my mind was number ' + number + '.')
