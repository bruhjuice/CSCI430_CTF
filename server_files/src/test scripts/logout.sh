#!/bin/bash


# Log in and obtain session cookies
cookies=$(sudo curl -s -c - 'localhost/login.php?user=apple&pass=apple' | grep 'PHPSESSID' | awk '{print $7}')

# Log out and check for successful logout message
echo 'Testing successful logout'
logout_response=$(sudo curl -s -b "PHPSESSID=$cookies" 'localhost/logout.php')
if [[ "$logout_response" =~ "Logout Successful" ]]; then
    echo 'Logout test passed'
else
    echo 'Logout test failed'
fi