# Use official PHP + Apache image
FROM php:8.2-apache

# Install PostgreSQL extension
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pgsql pdo_pgsql

# Set working directory
WORKDIR /var/www/html

# Copy all project files to the container's web root
COPY . .

# Expose port 80 (standard for web)
EXPOSE 80
