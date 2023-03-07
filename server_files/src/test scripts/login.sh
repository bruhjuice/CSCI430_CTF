#!/bin/bash

# Test case 1: Missing username and password
result=$(curl -s "localhost:80/src/login.php")
if test "$result" = "Missing Username or Password"; then
  echo "Test case 1 passed: Missing username and password"
else
  echo "Test case 1 failed: Missing username and password"
fi

# Test case 2: Invalid username or password
result=$(curl -s "localhost:80/src/login.php?user=nonexistent&pass=invalid")
if test "$result" = "Invalid Username or Password"; then
  echo "Test case 2 passed: Invalid username or password"
else
  echo "Test case 2 failed: Invalid username or password"
fi

# Test case 3: Successful login
result=$(curl -s "localhost:80/src/login.php?user=apple&pass=apple")
if test "$result" = "Login successful"; then
  echo "Test case 3 passed: Successful login"
else
  echo "Test case 3 failed: Successful login"
fi