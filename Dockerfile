FROM php:8.1-fpm

WORKDIR /var/www

# Install system dependencies
RUN apk update
RUN apk add --no-cache \
    libjpeg-turbo-dev \
    libpng-dev \
    libwebp-dev \
    freetype-dev \
    libzip-dev \
    zip \
    bash \
    dos2unix

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN docker-php-ext-install exif
RUN docker-php-ext-install zip
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install -j$(nproc) gd

#syns php.init
COPY ./docker/php/php.ini /usr/local/etc/php/

COPY . .

# Get latest Composer
RUN curl -sS https://getcomposer.org/installer | \
    php -- --install-dir=/usr/local/bin --filename=composer

# Copy the docker-app-start.sh script from the local directory into the container
COPY docker-start.sh /var/www/

# Set executable permission for docker-app-start.sh
RUN chmod 777 /var/www/docker-start.sh

CMD ["/var/www/docker-start.sh"]