#!/bin/bash

#Test case 1: User not logged in
result=$(curl -s "localhost:80/src/manage.php?action=testaction1&amount=testamt1")
if test "$result" = "You are not logged in"; then
    echo "Test case 1 passed"
else
    echo "Test case 1 failed: $result"
fi

#test case 2: Insufficient balance
result=$(curl -s "localhost:80/src/manage.php?action=withdraw&amount=testAmt2")
if test "$result" = "Insufficient funds!"; then
    echo "Test case 2 passed"
else
    echo "Test case 2 failed: $result"
fi

#test case3: successfull operation
result=$(curl -s "localhost:80/src/manage.php?action=testAction2&amount=testAmt3")
bal="New balance:"
if test [[ "$result" =~ .*"$bal".* ]]; then
    echo "Test case 3 passed"
else
    echo "Test case 3 failed: $result"
fi

