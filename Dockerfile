FROM php:7.0-cli
COPY ./src /app/src
COPY ./styles /app/styles
COPY ./vendor /app/vendor
COPY ./index.php /app
WORKDIR /app
CMD [ "php", "-S", "0.0.0.0:8000" ]