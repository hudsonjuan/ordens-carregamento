#!/bin/bash

# Wait for database to be ready
echo "Waiting for database..."
sleep 10

# Run migrations
echo "Running migrations..."
php artisan migrate --force

# Clear caches
echo "Clearing caches..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Start the server
echo "Starting server..."
php artisan serve --host=0.0.0.0 --port=$PORT
