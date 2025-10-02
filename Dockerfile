# Utilise PHP 8.2 avec FPM
FROM php:8.2-fpm

# Installe les dépendances système
RUN apt-get update && apt-get install -y \
    git unzip libpng-dev libonig-dev libxml2-dev zip curl \
    && docker-php-ext-install pdo_mysql bcmath gd

# Installe Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Définit le dossier de travail
WORKDIR /var/www

# Copie le code
COPY . .

# Installe les dépendances Laravel
RUN composer install --no-dev --optimize-autoloader

# Génère le cache Laravel
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# Expose le port
EXPOSE 8000

# Lance Laravel avec PHP built-in server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
