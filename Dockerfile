FROM jguyomard/laravel-php:latest

RUN apk add  libxml2-dev freetype libpng libpng-dev libjpeg-turbo freetype-dev libpng-dev libjpeg-turbo-dev && \
  docker-php-ext-configure gd \
    --with-gd \
    --with-freetype-dir=/usr/include/ \
    --with-png-dir=/usr/include/ \
    --with-jpeg-dir=/usr/include/ && \
  NPROC=$(grep -c ^processor /proc/cpuinfo 2>/dev/null || 1) && \
  docker-php-ext-install -j${NPROC} gd && \
  docker-php-ext-install soap   && \
  apk del --no-cache freetype-dev libpng-dev libjpeg-turbo-dev



# Set working directory
WORKDIR /var/www
#


# Copy existing application directory contents
COPY . /var/www

RUN chown -R www-data:www-data /var/www/public
RUN chown -R www-data:www-data /var/www/storage

 
 
# Expose port 9000 and start php-fpm server
EXPOSE 9000

CMD ["php-fpm"]
