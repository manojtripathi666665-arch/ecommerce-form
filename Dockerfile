# Use official PHP built-in webserver image
FROM php:8.2-cli

# Copy app files to /app directory
WORKDIR /app
COPY . /app

# Expose port 10000
EXPOSE 10000

# Start PHP built-in web server on port 10000
CMD ["php", "-S", "0.0.0.0:10000", "router.php"]
