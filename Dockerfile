FROM php:7.4-apache

# Install necessary packages and extensions
RUN apt-get update && apt-get upgrade -y && \
    apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev && \
    docker-php-ext-install -j$(nproc) iconv && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install -j$(nproc) gd && \
    docker-php-ext-install mysqli && \
    docker-php-ext-install pdo_mysql

# Copy source code to apache directory
COPY . /var/www/html/

# Make port 80 available to the world outside this container
EXPOSE 80
