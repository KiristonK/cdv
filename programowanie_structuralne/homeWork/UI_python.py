from tkinter import*

clicks = 0;

def click_button():
	global clicks
	clicks+=1
	btn.config(text="Clicks {}".format(clicks))


root = Tk()
root.title("Graphical programm via Python")
root.geometry("400x300+300+250")

btn = Button(text="Click Me",
			background="#555",
			foreground="#ccc",
			padx="20",
			pady="8",
			font="16",
			command=click_button)
btn.pack(expand = True, fill=BOTH)

root.mainloop()
