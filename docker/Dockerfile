FROM php:8.1-apache  AS php
LABEL "author"="bempime kheve"

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions intl | php -- --disable-tls

#error destination  ecrase defaut conf d'apache
#COPY ./docker/apache.conf /etc/apache2/sites-available/000-default.conf

ENV APP_ENV=prod
COPY . /var/www/

FROM composer:latest

#error Could not open input file: bin/console
# alias symfony pour php bin/console

RUN php bin/console cache:warmup && \
    chown -R www-data:www-data /var/www && \
    mkdir /database-app

VOLUME /database-app

WORKDIR /var/www/
ENTRYPOINT ["bash", "./docker/docker.sh"]
EXPOSE 80

#test verifier les copies de fichiers et les volumes