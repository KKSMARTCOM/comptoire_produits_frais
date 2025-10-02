# ----------- Base PHP FPM ----------
FROM php:8.2-fpm

# ----------- Installer dépendances système ----------
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl libonig-dev libpng-dev libjpeg-dev libfreetype6-dev nodejs npm \
    && docker-php-ext-install pdo_mysql bcmath mbstring gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# ----------- Installer Composer ----------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ----------- Définir le répertoire de travail ----------
WORKDIR /var/www

# ----------- Copier le projet ----------
COPY . .

# ----------- Installer les dépendances PHP ----------
RUN composer install --optimize-autoloader --no-dev

# ----------- Installer les dépendances JS et builder Vite ----------
RUN npm install \
    && npm run build

# ----------- Permissions (Laravel Storage & Cache) ----------
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# ----------- Optimisation Laravel (cache config, routes, views) ----------
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# ----------- Exposer le port pour Railway ----------
EXPOSE 8080

# ----------- Commande de lancement (PHP-FPM) ----------
CMD ["php-fpm"]
