#Base image for the container
FROM php:7.2-apache
#Install GIT, GnuPG, NodeJS and NPM
RUN apt-get update && apt-get install -y git gnupg && \
    curl -sL https://deb.nodesource.com/setup_10.x | bash - && \
    apt-get install -y nodejs

#Add Laravel necessary php extensioRUN dpkg --configure -a \
RUN apt-get update && apt-get install -y \
    unzip \
    vim \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libpq-dev \
    iputils-ping \
    && docker-php-ext-install -j$(nproc) zip mysqli pdo_mysql pdo pdo_pgsql opcache pgsql  \
        && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
        && docker-php-ext-install -j$(nproc) gd
    


# Borramos cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .
COPY cer_api.conf /etc/apache2/sites-available/
RUN a2enmod rewrite && \
    a2enmod actions && \
    a2enmod deflate && \
    a2enmod expires && \
    a2enmod headers && \
    a2enmod actions && \
    a2enmod proxy

RUN a2ensite cer_api.conf
RUN a2dissite 000-default.conf
RUN /etc/init.d/apache2 restart
EXPOSE 80
