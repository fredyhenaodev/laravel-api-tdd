# Toma como base la imagen ubunu:16.04
FROM ubuntu:16.04

# Nos da a conocer quien mantendrá la imagen
LABEL maintainer="Fredy Henao <fredyhenao45y@gmail.com>"

# Actualiza los repositorios (1)
# Instala locales UTF-8 (Para poder instalar php) (2-3)
RUN apt-get update \
  && apt-get install -y locales \
  && locale-gen en_US.UTF-8

# Se configura UTF-8 con las variables de entorno
ENV LANG=en_US.UTF-8
ENV LANGUAGE=en_US:en
ENV LC_ALL=en_US.UTF-8

# Instalacion de php
# Actualiza los repositorios (1)
# Instalación de paquetes necesarios (2-7)
# Agrega al repositorio de php (8)
# Instalación de php (9-20)
# Instalación de Composer (21)
# Crea la ruta de php (22)
# Desístala software-properties-common (23)
# Limpia los archivos generados durante la instalación (25-26)
RUN apt-get update \
  && apt-get install -y \
    curl \
    git \
    software-properties-common \
    unzip \
    zip \
    sqlite3 \
  && add-apt-repository -y ppa:ondrej/php \
  && apt-get update \
  && apt-get install -y \
    php7.4-cli \
    php7.4-curl \
    php7.4-fpm \
    php7.4-gd \
    php7.4-imap \
    php7.4-mbstring \
    php7.4-pgsql \
    php7.4-sqlite3 \
    php7.4-mysql \
    php7.4-xml \
    php7.4-zip \
    php7.4-bcmath \
    php-memcached \
  && php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer \
  && mkdir /run/php \
  && apt-get remove -y --purge software-properties-common \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Copia los archivos de configuración
COPY php.ini /etc/php/7.4/fpm/php.ini
COPY php-fpm.conf /etc/php/7.4/fpm/php-fpm.conf
COPY www.conf /etc/php/7.4/fpm/pool.d/www.conf
COPY ./script.sh /

# Add crontab file in the cron directory
#ADD crontab /etc/cron.d/scheduler

# Give execution rights on the cron job
#RUN chmod 0644 /etc/cron.d/scheduler

# Execution the cron
#RUN crontab /etc/cron.d/scheduler

# Expone el puerto 9000 para la comunicación entre contenedores
EXPOSE 9000

# Ejecuta el comando
CMD ["sh","/script.sh"]
