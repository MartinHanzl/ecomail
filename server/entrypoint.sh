#!/bin/bash

# Čekání na databázi
until mysql -h"$DB_HOST" -u"$DB_USERNAME" -p"$DB_PASSWORD" -e "SELECT 1" &> /dev/null
do
  sleep 2
done

# Spusť Laravel server
php artisan config:clear
php artisan migrate --force

exec php artisan serve --host=0.0.0.0 --port=8000
