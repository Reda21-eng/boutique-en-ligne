# Utilise une image officielle PHP avec Apache
FROM php:8.2-apache

# Installe les extensions nécessaires (mysqli pour MySQL, pdo, etc.)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Active le module rewrite d'Apache
RUN a2enmod rewrite

# Copie le code source dans le conteneur
COPY . /var/www/html/

# Donne les bons droits
RUN chown -R www-data:www-data /var/www/html

# Installe Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Installe les dépendances PHP
RUN composer install --no-interaction --prefer-dist --no-dev

# Expose le port 80
EXPOSE 80

# Utilise le fichier de configuration Apache par défaut
CMD ["apache2-foreground"]
