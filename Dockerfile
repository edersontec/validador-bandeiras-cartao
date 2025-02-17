FROM php:8.3-apache

# Instalar dependências do sistema e extensões PHP necessárias
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install zip

# Baixar e instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Habilitar o módulo de reescrita do Apache (arquivo .htaccess)
RUN a2enmod rewrite

# Definir diretório de trabalho
WORKDIR /var/www/html/

# Copiar código-fonte para o contêiner
COPY . /var/www/html/

# Instalar dependências do Composer
RUN composer install

# Expor a porta 80
EXPOSE 80

# QUESTION: Não posso colocar variáveis de ambiente no compose.yaml nem no Dockerfile, até porque são arquivos versionados.
# TODO: Entender qual a melhor prática de mercado para gerar arquivos .env em produção? Docker Secrets? Docker Swarm?
# Adicionar variáveis de ambiente ao arquivo .env (para fins didáticos)
RUN echo "BEARER_TOKEN=1234567890" >> /var/www/html/.env