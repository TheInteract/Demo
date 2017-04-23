FROM php:7.0-cli
COPY ./src /app/src
COPY ./src /app/demo/src
COPY ./vendor /app/vendor
COPY ./vendor /app/demo/vendor
COPY ./index.php /app
COPY ./index.php /app/demo/
COPY ./*.css /app/demo/
WORKDIR /app
CMD [ "php", "-S", "0.0.0.0:8000" ]