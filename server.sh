#!/bin/bash
host="localhost:3000"
echo "Opening Browser"
google-chrome 'http://'$host
echo "Starting Server"
php -S $host -t ./
