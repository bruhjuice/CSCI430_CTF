#!/bin/bash

# Get the port number from the user
echo "Scanning for open ports..."
open_ports=$(nmap -p- localhost | grep -E "(open|filtered)" | cut -d '/' -f 1 )
# Get the excluded ports from the command-line arguments
excluded_ports="$@"
if [ "$#" -gt 0 ]; then
    echo "Excluded ports: $excluded_ports"
fi

# Check if the port is excluded
for port in $open_ports; do
    if echo "$excluded_ports" | grep -wq "$port"; then
        echo "Port $port is excluded"
        continue
    fi

# Check if the port is open
    if sudo lsof -i :$port > /dev/null; then
        # Get the process ID of the process listening on the port
        pid=$(sudo lsof -t -i :$port)

        # Terminate the process
        echo "Closing port $port and terminating process $pid"
        sudo kill $pid

        # Wait for the process to terminate
        sleep 1

        # Check if the process is still running
        if sudo ps -p $pid > /dev/null; then
            echo "Failed to terminate process $pid"
            exit 1
        else
            echo "Process $pid terminated successfully"
        fi

        # Close the port
        echo "Closing port $port"
        sudo iptables -A INPUT -p tcp --dport $port -j DROP
        sudo iptables -A OUTPUT -p tcp --sport $port -j DROP

        # Check if the port is closed
        if sudo lsof -i :$port > /dev/null; then
            echo "Failed to close port $port"
            exit 1
        else
            echo "Port $port closed successfully"
        fi
    else
        echo "Port $port is not open"
    fi
done

