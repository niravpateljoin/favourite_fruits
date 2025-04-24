#!/bin/sh

# Wait for database to be ready
echo "Waiting for MySQL..."
until nc -z -v -w30 mysql 3306
do
  echo "Waiting for database connection..."
  sleep 2
done

echo "Database is up! Running migrations..."
php artisan migrate --force

echo "Starting Laravel application..."
php artisan serve --host=0.0.0.0 --port=8000
