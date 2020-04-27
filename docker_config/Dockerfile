FROM php:7.2-fpm

# Install PHP Extensions
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libxml2 \
        libxml2-dev \
        wget \
        libcurl4-gnutls-dev \
        bsdtar \
        libaio1 \
    libpq-dev \
#    && docker-php-ext-install -j$(nproc) iconv mcrypt \
#    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install -j$(nproc) zip \
    && docker-php-ext-install -j$(nproc) pdo_mysql \
    && docker-php-ext-install -j$(nproc) pdo_pgsql \
    && docker-php-ext-install -j$(nproc) json \
    && docker-php-ext-install -j$(nproc) soap \
    && docker-php-ext-install -j$(nproc) curl \
    && docker-php-ext-install -j$(nproc) mbstring 

RUN printf "log_errors = On \nerror_log = /dev/stderr\n" > /usr/local/etc/php/conf.d/php-logs.ini

# Install git, zip an unzip
RUN apt-get install -y git zip unzip

# Install libicu
RUN apt-get install -y libicu-dev \
    && docker-php-ext-install -j$(nproc) intl


# Install composer
RUN php -r "readfile('https://getcomposer.org/installer');" > composer-setup.php \
    && php composer-setup.php --install-dir=/usr/bin \
    && php -r "unlink('composer-setup.php');"


# Install bzip2
RUN apt-get install -y bzip2
