FROM php:8.2-apache

# Habilitar mod_rewrite para las rutas amigables
RUN a2enmod rewrite

# Instalar extensiones necesarias para la base de datos
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copiar el código fuente
COPY . /var/www/html/

# Configurar el DocumentRoot para que apunte a /public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# Permisos (opcional pero recomendado)
RUN chown -R www-data:www-data /var/www/html
