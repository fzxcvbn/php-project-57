FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    git \
    unzip \
    libonig-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader
RUN npm ci
RUN npm run build

RUN touch database/database.sqlite && chmod 666 database/database.sqlite

CMD ["sh", "-c", "php artisan serve --host=0.0.0.0 --port=${PORT:-8000}"]