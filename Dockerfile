# Imagen base oficial de PHP con Apache
FROM php:8.2-apache

# Activar mod_rewrite para permitir .htaccess
RUN a2enmod rewrite

# Cambiar DocumentRoot a /public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Permitir el uso de .htaccess en la nueva DocumentRoot
RUN sed -i '/<Directory \/var\/www\/html\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Instalar herramientas necesarias para Composer (git, unzip)
RUN apt-get update && apt-get install -y git unzip

# Copiar Composer desde imagen oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar el código del proyecto al contenedor
COPY . /var/www/html/

# Crear la carpeta cache y asegurar permisos para www-data (Apache)
RUN mkdir -p /var/www/html/cache && \
    chown -R www-data:www-data /var/www/html && \
    chmod -R 775 /var/www/html/cache

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Instalar dependencias PHP definidas en composer.json
RUN composer install

# Exponer el puerto 80 del servidor Apache
EXPOSE 80
