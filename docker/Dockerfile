FROM php:8.1-apache  AS php
LABEL "author"="bempime kheve"

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions intl && \
    curl -sSk https://getcomposer.org/installer | php -- --disable-tls && \
    mv composer.phar /usr/local/bin/composer && \
    apt update && apt install -yqq zip git

WORKDIR
COPY ./docker/apache.conf /etc/apache2/sites-available/000-default.conf
ENV APP_ENV=prod


#PB - les fichiers ne sont pas copie!
COPY . /var/www/

#composer install charge les dependances + l'autoloader
RUN composer install && \
    php bin/console cache:warmup && \
    chown -R www-data:www-data /var/www && \
    mkdir /database-app

VOLUME /database-app

WORKDIR /var/www/
ENTRYPOINT ["bash", "./docker/docker.sh"]
EXPOSE 80