FROM php:7.4-cli

RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

WORKDIR /app

COPY . .

RUN composer install

ENTRYPOINT ["vendor/bin/phpunit"]

