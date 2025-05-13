FROM nginx:alpine

RUN apk update \
    && apk upgrade \
    && apk add \
    vim \
    git \
    curl \
    wget \
    nano

# Set working directory
WORKDIR /var/www

# Copy existing application directory contents
COPY . /var/www
RUN mkdir -p /etc/nginx/certs/ssl \
&& cp -r .docker/nginx/conf.d -t /etc/nginx/ \
&& cp -r .docker/nginx/nginx.conf -t /etc/nginx/ \
&& cp -r .docker/nginx/ssl -t /etc/nginx/certs/