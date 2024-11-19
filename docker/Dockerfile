FROM php:apache
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Enable SSL
RUN set -eux; \
  apt-get update; \
  apt-get install ssl-cert; \
  a2enmod ssl; \
  a2ensite default-ssl
