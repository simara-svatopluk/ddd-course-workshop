FROM php:7.2-apache

MAINTAINER Lukas Benke

# Set workdir to /var/www - otherwise apache creates html dir in our source
WORKDIR /var/www

###########################################################################
# Non-root user:
###########################################################################

# Add a non-root user to prevent files being created with root permissions on host machine.
ARG PUID=1000
ENV PUID ${PUID}
ARG PGID=1000
ENV PGID ${PGID}

# always run apt update when start and after add new source list, then clean up at end.
RUN apt-get update -yqq && \
    pecl channel-update pecl.php.net && \
    groupadd -g ${PGID} appuser && \
    useradd -u ${PUID} -g appuser -m appuser -G appuser && \
    usermod -p "*" appuser && \
    usermod --shell /bin/bash appuser

#
#--------------------------------------------------------------------------
# Software's Installation
#--------------------------------------------------------------------------
#
# Installing tools and PHP extentions using "apt", "docker-php", "pecl",
#

# Install "curl", "libmemcached-dev", "libpq-dev", "libjpeg-dev",
#         "libpng-dev", "libfreetype6-dev", "libssl-dev", "libmcrypt-dev",
RUN apt-get update \
  && apt-get install -y --no-install-recommends \
    curl \
    libmemcached-dev \
    libz-dev \
    libpq-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    libssl-dev \
    libmcrypt-dev \
    unzip

  # Install the PHP pdo_mysql extention
RUN docker-php-ext-install pdo_mysql \
  # Install the PHP pdo_pgsql extention
  && docker-php-ext-install pdo_pgsql \
  # Install the PHP gd library
  && docker-php-ext-configure gd \
    --with-jpeg-dir=/usr/lib \
    --with-freetype-dir=/usr/include/freetype2 && \
    docker-php-ext-install gd

RUN docker-php-ext-install zip

###########################################################################
# ssh:
###########################################################################

RUN apt-get update \
  && apt-get install -y --no-install-recommends \
  openssh-server \
  openssh-client

RUN service ssh start

COPY insecure_id_rsa /tmp/id_rsa
COPY insecure_id_rsa.pub /tmp/id_rsa.pub

RUN mkdir /home/root
RUN mkdir /home/root/.ssh
RUN mkdir /home/appuser/.ssh

RUN cat /tmp/id_rsa.pub >> /home/root/.ssh/authorized_keys \
    && cat /tmp/id_rsa.pub >> /home/root/.ssh/id_rsa.pub \
    && cat /tmp/id_rsa >> /home/root/.ssh/id_rsa \
    && rm -f /tmp/id_rsa* \
    && chmod 644 /home/root/.ssh/authorized_keys /home/root/.ssh/id_rsa.pub \
&& chmod 400 /home/root/.ssh/id_rsa \
&& cp -rf /home/root/.ssh /home/appuser \
&& chown -R appuser:appuser /home/appuser/.ssh

COPY app/ssh/sshd_config /etc/ssh/sshd_config

#####################################
# Composer:
#####################################

# Install composer and add its bin to the PATH.
RUN curl -s http://getcomposer.org/installer | php && \
    echo "export PATH=${PATH}:/var/www/vendor/bin" >> ~/.bashrc && \
    mv composer.phar /usr/local/bin/composer

# Source the bash
RUN . ~/.bashrc

COPY app/vhost.conf /etc/apache2/sites-available/000-default.conf

RUN chown -R www-data:www-data /var/www \
    && a2enmod rewrite

ENTRYPOINT service ssh start && apache2-foreground