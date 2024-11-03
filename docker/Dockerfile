FROM php:apache
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Enable SSL
RUN set -eux; \
  apt-get update; \
  apt-get install ssl-cert; \
  a2enmod ssl; \
  a2ensite default-ssl

# RUN curl -L https://github.com/smarty-php/smarty/archive/refs/tags/v4.5.2.tar.gz -o smarty.tar.gz
RUN curl -L https://github.com/smarty-php/smarty/archive/refs/tags/v2.6.31.tar.gz -o smarty.tar.gz
RUN tar -zxvf smarty.tar.gz
RUN mkdir /usr/local/lib/php/Smarty
RUN cp -r smarty-2.6.31/libs/* /usr/local/lib/php/Smarty
RUN rm -Rf ./smarty-2.6.31
# RUN rm -Rf ./smarty-4.5.2
RUN rm smarty.tar.gz
