export host="localhost:3000"
php -S $host -t ./public
echo "Opening Browser"
google-chrome $host
