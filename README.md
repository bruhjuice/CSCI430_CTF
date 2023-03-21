# CSCI430_CTF
Banking web app for CS430's CTF group project

## Run setup script and Apache/MySQL
1. SCP files from computer to deterlab:
For folders: `scp -r server_files\ [username]@users.isi.deterlab.net:[destination folder]` 
For files:
`scp [filenames] usc430aw@users.isi.deterlab.net:[destination folder]`

2. Go the setup.sh script and run it, you may need to give execution privileges.
Give execution privileges: `sudo chmod +x ./setup.sh`
Run setup script: `./setup.sh`

3. While the setup script is running, you will be asked to pick a root password for mysql database. Feel free to use the default (do not enter anything and hit return) for testing but secure the server with a real password for ctf. Afterwards you will be asked to enter this password (you must type it out even if it is the default password)

## Check Standard Ports

1. Run `nmap -p- localhost | grep -E “(open|filtered)” | cut -d ‘/’ -f 1`
2. Make a list of the standard ports.

## Deploy close ports script
1. Add the port numbers into the script
2. Create a text file for the logs
3. Give execute and write permissions on the file
4. Open crontab -e
5. Add the rule: `* * * * * /bin/bash /users/usc430xx/close_ports_service.sh >> /users/usc430xx/test.txt 2>&1`
6. Run `sudo service cron restart`
7. Use `sudo grep CRON /var/log/syslog or cat log.txt` to check for logs

## Instructions for SQL Injections
1. Make sure sqlmap software and python are downloaded to the system
2. Navigate to the filepath of the sqlmap software
3. Run this command 'sqlmap -u "http://<blue_server>/blue/login.php?user=<username>&pass=<password>" --cookie="<cookie>" --data="action=<action>&amount=<amount>" --level=5 --risk=3 --batch --dump` , where <blue_server> would be replaced with the URL or IP address of the web server running the banking application, and the username, password, action, and amount would be replaced with the appropriate values for the attack. The --cookie option specifies the cookie value obtained from the login page, which is used to maintain the session throughout the attack.
4. sqlmap will automatically exploit all vulnerabilities



## Run test cases
1. Go to the test scripts folder
2. Run the tests, you may need to give yourself execution privileges

## Additional Information
**PortScanning.md** - useful commands on how to scan port and defend 

