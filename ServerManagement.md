# Server Management

## View Error Logs:
Run command: `sudo less /var/log/apache2/error.log`

Sample log line:
```[Sat Mar 18 23:08:08.697947 2023] [php7:notice] [pid 19563] [client 127.0.0.1:53576] [SessionId 123456]  INFO Message```

Each line contains: Timestamp, ProcessId, Client ip and port, SessionId and a message.
Messages have be tagged three ways: INFO, WARNING or ERROR. INFO just indicates a user action. WARNING is for a failed user action. ERROR is for issues with our code or suspected attacks.

You can grep and use a processId/SessionId/IP address to see all the logs for a specific user/ip. The processId is for a single request, the sessionId is for a single user session and the ip address will show all requests from a specific ip.

## View Acces Logs:
The error logs should contain all the information that is needed but there are also access logs which show all incoming requests. Use the following command to view: `sudo less /var/log/apache2/access.log`


## Modify Server Files:
`sudo nano /var/www/html/path_to_file`

BE VERY CAREFUL WHEN MODIFYING LIVE FILES. We don't want to break out server in the middle of the ctf.

