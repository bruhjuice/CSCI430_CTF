#!/bin/bash

# Obtain session cookies from login.php
cookies=$(sudo curl -s -c - 'localhost/login.php?user=apple&pass=apple' | grep 'PHPSESSID' | awk '{print $7}')

# Make a deposit of $50
echo 'Testing legitimate deposit'
deposit_response=$(sudo curl -s -b "PHPSESSID=$cookies" 'localhost/manage.php?action=deposit&amount=50')
echo $deposit_response
echo ""

# Make a withdrawak of $10
echo 'Testing legitimate withdraw'
withL_response=$(sudo curl -s -b "PHPSESSID=$cookies" 'localhost/manage.php?action=withdraw&amount=10')
echo $withL_response
echo ""

# Check balance
echo 'checking balance'
balance_response=$(sudo curl -s -b "PHPSESSID=$cookies" 'localhost/manage.php?action=balance')
echo $balance_response 
echo ""

# Attempt to withdraw $10000 (should fail due to insufficient funds)
echo 'checking withdrawl where balance < amount requested'
withdraw_response=$(sudo curl -s -b "PHPSESSID=$cookies" 'localhost/manage.php?action=withdraw&amount=10000')
echo $withdraw_response 
echo ""

# Log out
logout_response=$(sudo curl -s -b "PHPSESSID=$cookies" 'localhost/logout.php')
echo $logout_response 
echo ""


# Check for logged out session
echo 'checking for logged out session'
logged_out_response=$(sudo curl -s -b "PHPSESSID=$cookies" 'localhost/manage.php?action=balance')
echo $logged_out_response
echo ""