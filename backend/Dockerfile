# Use a imagem PHP com Apache
FROM php:8.2-apache

# Instale as dependências e extensões necessárias
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Copie o Composer da imagem oficial do Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Defina o diretório de trabalho
WORKDIR /var/www/html

# Copie os arquivos do projeto para dentro do container
COPY . .

# Instale as dependências do Composer
RUN composer install

# Ative módulos do Apache se necessário (por exemplo, mod_rewrite)
RUN a2enmod rewrite

# Exponha a porta 80 (que será mapeada externamente)
EXPOSE 80
