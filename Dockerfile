FROM php:7.0-cli
COPY ./src /app/src
COPY ./vendor /app/vendor
COPY ./healthz.php /app/
COPY ./index.php /app/
COPY ./*.css /app/
WORKDIR /app
CMD [ "php", "-S", "0.0.0.0:8000" ]