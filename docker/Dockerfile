FROM php:8.1-apache
LABEL bempime kheve
WORKDIR /var/www/html
COPY ../public ./public
COPY ../src ./src
COPY ../templates ./templates
#.env.production

FROM composer:latest AS composer
COPY composer.json composer.lock ./
RUN composer install --no-plugins --no-scripts

RUN mkdir /database-app
VOLUME /database-app

EXPOSE 80
#docker run this cmd
#CMD ["command", "arg1", "arg2", ...]
CMD []