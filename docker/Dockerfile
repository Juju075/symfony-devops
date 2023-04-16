FROM php:8.1-apache
FROM composer:latest AS composer

LABEL bempime kheve
WORKDIR /var/www/html   #app mapped
#app  faire mapping


COPY ../src ./src
COPY ../public ./public
COPY ../templates ./templates

# files config/ packages et routes
#RUN composer install # utilise image as composer https://hub.docker.com/_/composer
#RUN php bin/console cache:clear

# ne pas inclure dev
COPY composer.json composer.lock ./
RUN composer install --no-plugins --no-scripts

# add `/app/node_modules/.bin` to $PATH
#  docker compose build [OPTIONS] [SERVICE...]

VOLUMES >docker compose

#Run the build
RUN

EXPOSE 80
CMD ["apache2-foreground"]