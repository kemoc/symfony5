FROM composer:2.0 as composer

FROM php:8.0-fpm

MAINTAINER Radek Z.

ENV PROJECTMAPPINGFOLDER="/var/www/project"

COPY --from=composer /usr/bin/composer /usr/local/bin/composer

RUN php -m

RUN sleep 5

RUN apt-get update && \
apt-get install -y \
libzip-dev

RUN apt install -y apt-utils
RUN apt update

RUN apt install -y zip unzip
RUN apt install -y vim nano wget

RUN apt install -y findutils \
    libicu-dev \
    less \
    libbz2-1.0 \
    libevent-2.1-6 \
    libxslt1.1 \
    make \
    libssl-dev \
    mariadb-client

RUN apt install -y curl
RUN apt install -y libcurl3-gnutls
RUN apt install -y zlib1g-dev libicu-dev g++
RUN apt install -y libcurl4-openssl-dev
RUN docker-php-ext-install curl
RUN docker-php-ext-enable curl

# https://github.com/cicnavi/dockers/blob/master/dap/80/Dockerfile
RUN phpModules=" \
  zip \
  "
RUN docker-php-ext-install zip
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install intl
RUN apt update && \
    apt install -y libxml2-dev
RUN docker-php-ext-install soap

RUN apt install -y libonig-dev
RUN docker-php-ext-install mbstring

RUN docker-php-ext-install opcache

RUN pecl install xdebug
RUN docker-php-ext-enable xdebug


#RUN pecl install apcu
#RUN docker-php-ext-enable apcu
RUN wget https://get.symfony.com/cli/installer -O - | bash
RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony

RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

ENV TZ=Europe/Warsaw
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

#RUN curl "https://github.com/fabpot/local-php-security-checker/releases/download/v1.0.0/local-php-security-checker_1.0.0_linux_amd64"  --output /usr/local/bin/local-php-security-checker
RUN wget -O /usr/local/bin/local-php-security-checker "https://github.com/fabpot/local-php-security-checker/releases/download/v1.0.0/local-php-security-checker_1.0.0_linux_amd64"
RUN chmod a+rx /usr/local/bin/local-php-security-checker
# local-php-security-checker --path=$PROJECTMAPPINGFOLDER

COPY entrypoint.bash /entrypoint.bash
RUN chmod a+x /entrypoint.bash
# https://github.com/docker/docker.github.io/issues/6142
ENTRYPOINT ["docker-php-entrypoint", "/entrypoint.bash"]

RUN mkdir $PROJECTMAPPINGFOLDER
WORKDIR $PROJECTMAPPINGFOLDER
RUN cd $PROJECTMAPPINGFOLDER

ENV PATH="$PATH:$PROJECTMAPPINGFOLDER/vendor/bin/:$PROJECTMAPPINGFOLDER/bin/"

# Cleanup the image
RUN rm -rf /var/lib/apt/lists/* /tmp/*

# https://github.com/docker/docker.github.io/issues/6142
CMD ["php-fpm"]