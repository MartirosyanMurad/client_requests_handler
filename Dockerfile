FROM php:7.4-cli

RUN apt-get update
RUN docker-php-ext-install pcntl
RUN apt-get -y install git

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /root/client_request
WORKDIR /root/client_request

RUN composer install
RUN apt-get install -y procps
ENTRYPOINT ["php", "start.php"]