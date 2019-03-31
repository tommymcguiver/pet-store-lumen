########################
# PHP COMPOSER BUILD
########################

FROM composer as backend
WORKDIR /app

COPY . /app/

RUN composer global require hirak/prestissimo --no-plugins --no-scripts
RUN composer install  \
  --ignore-platform-reqs \
  --no-ansi \
  --no-autoloader \
  --no-interaction \
  --no-scripts

RUN composer dump-autoload --optimize --classmap-authoritative

########################
# APACHE/PHP SERVER BUILD
########################

FROM php:7.3-apache
LABEL maintainer "Nizar El Berjawi <nizarberjawi12@gmail.com>"

# Set Apache environment variables
ENV APACHE_RUN_DIR /var/run/apache2
ENV APACHE_SERVER_NAME localhost

# Set timezone
ENV TZ "Australia/Brisbane"
RUN echo $TZ > /etc/timezone && dpkg-reconfigure -f noninteractive tzdata

COPY .docker/local/apache/sites-available/000-default.conf /etc/apache2/sites-available/000-default.conf
RUN ln -sf /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-enabled/000-default.conf

# Install packages required to run composer properly
RUN apt-get update && apt-get install -y git zip unzip \
  && docker-php-ext-install pdo_mysql mbstring

WORKDIR /var/www/html
COPY --from=backend /app /var/www/html

RUN a2enmod rewrite \
  && service apache2 restart

RUN chgrp -R www-data /var/www/html/storage \
  && chmod -R ug+rwx /var/www/html/storage

EXPOSE 80
