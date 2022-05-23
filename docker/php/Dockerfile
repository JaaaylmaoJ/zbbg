#FROM php:7.4.23-fpm-alpine3.13
FROM php:8.0.3-fpm-alpine3.13

#ARG GITLAB_BIGLAND_URL=gitlab.bigland.ru

WORKDIR /var/www/html

ADD  https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions  /usr/local/bin/
RUN chmod uga+x /usr/local/bin/install-php-extensions && sync \
 && echo http://dl-2.alpinelinux.org/alpine/edge/community/ >> /etc/apk/repositories \
 && apk --no-cache add shadow su-exec git openssh-client

RUN install-php-extensions \
  ffi \
  apcu \
  opcache \
  memcached \
  zip \
  bcmath \
  intl \
  mbstring
  #iconv \
  #json \
  #xml \
  #curl \

RUN install-php-extensions pdo_mysql
RUN install-php-extensions mysqli

# Install composerred
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --version=2.0.14 \
    --install-dir=/usr/bin

RUN install-php-extensions xdebug

# Cleanup apk cache
RUN rm -rf /var/cache/apk/* \
 && rm -rf /tmp/*


COPY ./docker/php/docker-entrypoint.sh /usr/local/bin/

RUN chmod 775 /usr/local/bin/docker-entrypoint.sh \
 && ln -s     /usr/local/bin/docker-entrypoint.sh /

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["php-fpm"]
