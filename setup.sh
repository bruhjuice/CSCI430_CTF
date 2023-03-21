#!/bin/bash

# Install mysql
sudo apt install mysql-server -y

# Install Apache
sudo apt install apache2 -y

# Install PHP and connectors
sudo apt install php libapache2-mod-php php-mysql -y

# Kill sql instance to reset password
sudo kill `sudo cat /var/run/mysqld/mysqld.pid`

# Get user input for root password
read -sp 'Choose SQL Root Password (default is testing123): ' passvar
printf "\nUpdating root user..."
if [ -z ${passvar} ];
then
    passvar="testing123"
fi
echo "ALTER USER 'root'@'localhost' IDENTIFIED BY '$passvar';"  > mysql-init

# Reset password for root to what is stored in mysql-init file
sudo mysqld --init-file=mysql-init

# Delete mysql-init
sudo rm mysql-init

# Start sql server
sudo systemctl start mysql
sudo systemctl enable mysql

# Start apache server
sudo systemctl start apache2
sudo systemctl enable apache2

# Check server status
sudo systemctl status mysql
sudo systemctl status apache2

# sudo mysql_secure_installation

# Use following command to log into sql server as root
# sudo mysql -u root -p

sudo mysql -u root -p < databaseSetup.sql
sudo cp -r server_files/. /var/www/html/

# Add configuration for .htaccess file
sed -n '/^<Directory \/var\/www\/>$/,/^</ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf
sudo a2enmod rewrite
sudo systemctl restart apache2

# Block SSH requests from blue node
sudo iptables -A INPUT -p tcp --dport 22 --source 192.168.0.0/16 -j ACCEPT
sudo iptables -A INPUT -p tcp --dport 22 -j DROP