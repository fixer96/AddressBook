FROM php:7.2-apache

# update packages
RUN apt-get update && \
    apt-get upgrade -y

# install new packages
RUN apt-get install -y \
    zlib1g-dev libicu-dev g++ \
    libzip-dev \
    zip
# zip extension
RUN docker-php-ext-configure zip --with-libzip
RUN docker-php-ext-install zip
# intl extension
RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl

# clear unused packages
RUN apt-get autoremove -y

# install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# custom apache config
COPY 000-default.conf /etc/apache2/sites-available

# fix permission issue (by default user is root)
# todo: make user id as a parameter
RUN usermod -u 1000 www-data

# set memory_limit 512M (128 by default)
RUN echo 'memory_limit = 512M' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini;

WORKDIR /var/www/html
