FROM php:7.4-cli

RUN apt-get update
RUN docker-php-ext-install pcntl

COPY . /root/client_request
WORKDIR /root/client_request

RUN apt-get install -y procps
ENTRYPOINT ["php", "start.php"]