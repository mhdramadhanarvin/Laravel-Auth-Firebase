FROM php:8.0-fpm

RUN apt-get update && apt-get install -y  \
    libfreetype6-dev \
    libjpeg-dev \
    libpng-dev \
    libwebp-dev \
    git \
    unzip \
    curl \
    # nodejs \
    # npm \
    --no-install-recommends \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql -j$(nproc) gd

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# RUN curl https://raw.githubusercontent.com/creationix/nvm/master/install.sh | bash \
#     && chmod +x ~/.profile \
#     && ~/.profile \
#     nvm install v16.15.0 \
#     nvm use v16.15.0

ENV NODE_VERSION=16.14.0
RUN curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.0/install.sh | bash
ENV NVM_DIR=/root/.nvm
RUN . "$NVM_DIR/nvm.sh" && nvm install ${NODE_VERSION}
RUN . "$NVM_DIR/nvm.sh" && nvm use v${NODE_VERSION}
RUN . "$NVM_DIR/nvm.sh" && nvm alias default v${NODE_VERSION}
ENV PATH="/root/.nvm/versions/node/v${NODE_VERSION}/bin/:${PATH}"
RUN node --version
RUN npm --version 