#!/bin/bash

for (( i=1; i<=$1; i++ ))
do
    a=$(( RANDOM % 255 ))
    b=$(( RANDOM % 255 ))
    c=$(( RANDOM % 255 ))
    sudo ifconfig eth4:$a 1.$c.$b.$a up
done
