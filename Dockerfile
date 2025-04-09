# Usamos una imagen oficial de PHP con Apache preinstalado
FROM php:8.2-apache

# Activamos el módulo de Apache que permite reescritura de URLs (necesario para .htaccess)
RUN a2enmod rewrite

# Cambiamos el DocumentRoot de Apache a la carpeta /public (como en Laravel o proyectos modernos)
# Así Apache sirve directamente desde /var/www/html/public en lugar de la raíz
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Copiamos todo el contenido del proyecto (código fuente, composer.json, etc.) al contenedor
COPY . /var/www/html/

# Permitimos que Apache respete las reglas de .htaccess dentro del contenedor
RUN sed -i '/<Directory \/var\/www\/html\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Traemos Composer desde su imagen oficial para instalar dependencias PHP
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecemos el directorio de trabajo donde está el composer.json
WORKDIR /var/www/html

# Instalamos las dependencias del proyecto (incluyendo PHPUnit si lo tienes como dev)
RUN composer install

# Exponemos el puerto 80 del contenedor (el que Apache usa)
EXPOSE 80
