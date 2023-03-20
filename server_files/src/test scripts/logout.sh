#!/bin/bash

# Test case successfull logout
result=$(curl -s "localhost:80/src/logout.php")
if test "$result" = "Logout Successful"; then
  echo "Test case passed"
else
  echo "Test case failed"
fi