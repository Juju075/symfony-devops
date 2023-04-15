FROM php:8.1-apache
FROM composer:latest AS composer

LABEL bempime kheve
WORKDIR /var/www/html
COPY ../src ./src
COPY ../public ./public
#COPY . ./

# files config/ packages et routes
# templates

#RUN composer install # utilise image as composer https://hub.docker.com/_/composer
#RUN php bin/console cache:clear

# ne pas inclure dev
COPY composer.json composer.lock ./
RUN composer install --no-plugins --no-scripts


# add `/app/node_modules/.bin` to $PATH
ENV PATH .bin:$PATH

VOLUMES


#Run the build
RUN


# production environment
FROM
COPY


EXPOSE 80
CMD ["apache2-foreground"]