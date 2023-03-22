#!/bin/bash

# Test case 1: Username already in use
result=$(curl -s "localhost:80/register.php?user=testuser1&pass=testpass1")
if test "$result" = "Username already in use"; then
    echo "Test case 1 passed"
else
    echo "Test case 1 failed: $result"
fi

# Test case 2: Username cannot be empty
result=$(curl -s "localhost:80/register.php?user=&pass=testpass2")
if test "$result" = "Missing username/password"; then
    echo "Test case 2 passed"
else
    echo "Test case 2 failed: $result"
fi

# Test case 3: Password cannot be empty
result=$(curl -s "localhost:80/register.php?user=testuser3&pass=")
if test "$result" = "Missing username/password"; then
    echo "Test case 3 passed"
else
    echo "Test case 3 failed: $result"
fi

# Test case 4: Username already in use
result=$(curl -s "localhost:80/register.php?user=testuser1&pass=testpass4")
if test "$result" = "Username already in use"; then
    echo "Test case 4 passed"
else
    echo "Test case 4 failed: $result"
fi

# Test case 5: Missing username/password
result=$(curl -s "localhost:80/register.php")
if test "$result" = "Missing username/password"; then
    echo "Test case 5 passed"
else
    echo "Test case 5 failed: $result"
fi