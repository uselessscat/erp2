FROM debian:10

RUN apt-get update \
    && apt-get install -y apache2 php7.3 libapache2-mod-php7.3 php7.3-mysql

COPY ./config/000-default.conf /etc/apache2/sites-available

EXPOSE 80

CMD ["/usr/sbin/apache2ctl", "-DFOREGROUND"]