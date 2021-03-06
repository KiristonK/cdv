import random
import os


HANGMAN_PICS = ['''
+---+
    |
    |
    |
  ===''', '''
+---+
    |
    |
    |
  ===''', '''
+---+
  0 |
  | |
  | |
  ===''', '''
+---+
  0 |
 /| |
    |
  ===''', '''
+---+
  0 |
 /|\|
    |
  ===''', '''
+---+
  0 |
 /|\|
 /  |
  ===''', '''
+---+
  0 |
 /|\|
 / \|
  ===''']

def getRandomWord(wordlist):
	wordindex = random.randint(0, len(wordlist)-1)
	return wordlist[wordindex]

def displayBoard(missedLetters, correctLetters, secretWord):
	print(HANGMAN_PICS[len(missedLetters)])
	print()


	print('Ошибочные буквы:',end=' ')
	for letter in missedLetters:
		print(letter, end=' ')
	print()

	blanks = '_' * len(secretWord)

	for i in range(len(secretWord)):
		if secretWord[i] in correctLetters:
			blanks = blanks[:i] + secretWord[i] + blanks[i+1:]

	for letter in blanks:
		print (letter,end=" ")
	print()

	if blanks == secretWord:
			print('ДА! Секретное слово - "' + secretWord + '"! Вы угадали!')
			return True
	else:
		return False

def getGuess(alreadyGuessed):
	while True:
		print('Введите букву.')
		guess = input().lower()
		if len(guess) != 1:
			print('Пожалуйста введите букву.')
		elif guess in alreadyGuessed:
			print('Вы уже называли эту букву. Назовите другую.')
		elif guess not in 'абвгдеёжзийклмнопрстуфхцчшщъыьэюя':
			print('Пожалуйста, введите БУКВУ из русского алфавита.')
		else:
			return guess

def playAgain():
	print('Хотите сыграть еще ? (да или нет)')
	return input().lower().startswith('д')


words = 'аист акула бабуин баран барсук бобр бык верблюд волк воробей ворон выдра голубь гусь жаба зебра змея индюк кит кобра коза козел койот корова кошка кролик крыса курица лама ласка лебедь лев лиса лосось лось лягушка медведь моллюск моль мул муравей мышь норка носорог обезьяна овца окунь олень орел осел панда паук питон попугай пума семга скунс собака сова тигр тритон тюлень утка форель хорек черепаха ястреб ящерица'.split()
missedLetters = ""
correctLetters = ""
secretWord = getRandomWord(words)

while True:
	os.system('cls')
	print('В И С Е Л И Ц А')
	gameIsDone = displayBoard(missedLetters, correctLetters, secretWord)

	if gameIsDone == False:
		guess = getGuess(missedLetters + correctLetters)

	if guess in secretWord:
		correctLetters = correctLetters + guess
	else:
		missedLetters = missedLetters + guess
		if len(missedLetters) == len(HANGMAN_PICS)-1:
			print('Вы исчерпали все попытки!\nНе угадано букв: '+str(len(missedLetters))+' и угадано букв: '+str(len(correctLetters))+'. Было загадано слово "'+secretWord+'".')
			gameIsDone = True

	if gameIsDone:
		if playAgain():
			missedLetters = ''
			correctLetters = ''
			gameIsDone = False
			secretWord = getRandomWord(words)
		else:
			break


















