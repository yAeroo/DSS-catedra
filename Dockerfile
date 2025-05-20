# Base image
FROM ubuntu

# Environment variables for MySQL
ENV DEBIAN_FRONTEND=noninteractive \
    MYSQL_ROOT_PASSWORD=secret \
    MYSQL_DATABASE=laravel \
    MYSQL_USER=laravel \
    MYSQL_PASSWORD=secret

# Update system and install dependencies
RUN apt-get update && apt-get install -y \
    apache2 \
    mysql-server \
    php \
    php-mysql \
    php-cli \
    php-mbstring \
    php-xml \
    php-bcmath \
    php-curl \
    php-zip \
    php-gd \
    libapache2-mod-php \
    unzip \
    curl \
    git \
    supervisor

# Node.js installation
RUN apt install nodejs -y
RUN apt install npm -y

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy Laravel project
COPY . /var/www/html

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html

# Set DocumentRoot to /var/www/html/public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
    && echo '<Directory /var/www/html/public>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' >> /etc/apache2/apache2.conf
# Initialize MySQL and Laravel environment
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Supervisor config to manage Apache and MySQL
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Expose web port
EXPOSE 80

RUN npm install
RUN npm run build

# Run entrypoint
CMD ["docker-entrypoint.sh"]
