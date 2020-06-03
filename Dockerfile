FROM arsaga/laravel-alpine:7.2-zip
ADD . /app
RUN apk --update add tzdata && \
    cp /usr/share/zoneinfo/Asia/Tokyo /etc/localtime && \
    apk del tzdata && \
    rm -rf /var/cache/apk/*
RUN apk add git
RUN git clone https://github.com/phpredis/phpredis.git /usr/src/php/ext/redis
RUN docker-php-ext-install redis
RUN chown -fR www-data:www-data /app
WORKDIR /app
RUN cp -p .env.example .env
RUN php artisan key:generate
RUN php artisan up