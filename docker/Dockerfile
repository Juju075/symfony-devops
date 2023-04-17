FROM php:8.1-apache
LABEL "author"="bempime kheve"
WORKDIR /var/www/html
COPY ../public /var/www/html/public
COPY ../src ./src
COPY ../templates ./templates

FROM composer:latest AS composer
#COPY ../composer.json ../composer.lock
#RUN composer install --no-plugins --no-scripts

#./  app du container
COPY testAjoutFichier.dm ./
#COPY ../composer.json ./
RUN mkdir /database-app
VOLUME /database-app
EXPOSE 80

#corrige cmd mauvais apache
#CMD ["apache2-foreground"]