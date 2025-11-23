FROM php:8.2-fpm-alpine

# 作業ディレクトリを設定
WORKDIR /var/www

# 適宜追加する
RUN apk add --no-cache \
    git \
    unzip \
    oniguruma-dev

# LaravelでMySQL使用に必要なPHP拡張
RUN docker-php-ext-install \
    pdo_mysql \
    mbstring

# Composerをインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 権限設定
RUN chown -R www-data:www-data /var/www

USER www-data

CMD ["php-fpm"]
