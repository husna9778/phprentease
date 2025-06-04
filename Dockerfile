# Use official PHP image with Apache
FROM php:8.2-apache

# Copy project files into Apache's root directory
COPY . /var/www/html/

# Optional: enable Apache rewrite module (if using .htaccess)
RUN a2enmod rewrite

# Expose port 80 (Render uses this by default)
EXPOSE 80
