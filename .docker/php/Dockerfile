FROM php:8.3-fpm

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions @composer

RUN install-php-extensions opcache
RUN install-php-extensions pdo_mysql
RUN install-php-extensions soap
RUN install-php-extensions pdo_sqlsrv
RUN install-php-extensions sqlsrv
RUN install-php-extensions bcmath
RUN install-php-extensions mbstring
RUN install-php-extensions zip

# COPY ./imagemagick-policy.xml /etc/ImageMagick-6/policy.xml

