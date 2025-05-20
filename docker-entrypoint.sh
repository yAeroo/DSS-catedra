#!/bin/bash

# Start MySQL
service mysql start

# Setup MySQL if not already initialized
if [ ! -d "/var/lib/mysql/laravel" ]; then
    echo "Initializing MySQL..."
    mysql -u root <<-EOSQL
        CREATE DATABASE IF NOT EXISTS ${MYSQL_DATABASE};
        CREATE USER IF NOT EXISTS '${MYSQL_USER}'@'localhost' IDENTIFIED BY '${MYSQL_PASSWORD}';
        GRANT ALL PRIVILEGES ON ${MYSQL_DATABASE}.* TO '${MYSQL_USER}'@'localhost';
        FLUSH PRIVILEGES;
EOSQL
fi

# Ir al directorio del proyecto
cd /var/www/html

# Instalar dependencias PHP si falta vendor/
if [ ! -d "vendor" ]; then
    echo "Installing PHP dependencies..."
    composer install
fi

# Instalar dependencias JS si falta node_modules/
if [ ! -d "node_modules" ]; then
    echo "Installing Node dependencies..."
    npm install
fi

# Build assets si no existe la carpeta build
if [ ! -d "public/build" ]; then
    echo "Running Vite build..."
    npm run build
fi

# Ejecutar comandos de Laravel
if [ -f artisan ]; then
    php artisan config:clear
    php artisan migrate:fresh --seed --force || true
fi

# Iniciar Apache + MySQL con Supervisor
exec /usr/bin/supervisord -n
