FROM webdevops/php-apache-dev:7.4

RUN mkdir -p /usr/local/etc/php/conf.d/
# RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli