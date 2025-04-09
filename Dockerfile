# Imagen base oficial de PHP con Apache
FROM php:8.2-apache

# Activar mod_rewrite para .htaccess
RUN a2enmod rewrite

# Cambiar el DocumentRoot para que apunte a /public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Copiar los archivos del proyecto
COPY . /var/www/html/

# Permitir reglas .htaccess
RUN sed -i '/<Directory \/var\/www\/html\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Instalar git y unzip para evitar errores de composer
RUN apt-get update && apt-get install -y git unzip

# Traer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer el directorio de trabajo donde está composer.json
WORKDIR /var/www/html

# Instalar dependencias PHP del proyecto
RUN composer install

# Exponer el puerto de Apache
EXPOSE 80
