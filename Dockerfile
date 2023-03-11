FROM opeoniye/dclm-php74-base:latest

# set working director
WORKDIR /var/www

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy code to /var/www
COPY --chown=www:www-data ./src /var/www
COPY ./ops/docker /var/www/docker

# add root to www group
RUN chmod -R ug+w /var/www/storage

# Copy nginx/php/supervisor configs
COPY ./ops/docker/supervisor.conf /etc/supervisord.conf
COPY ./ops/docker/php/php.ini /usr/local/etc/php/conf.d/app.ini
COPY ./ops/docker/ngx/nginx.conf /etc/nginx/sites-enabled/default
COPY ./ops/docker/run.sh /var/www/docker/run.sh

# PHP Error Log Files
RUN mkdir /var/log/php
RUN touch /var/log/php/errors.log && chmod 777 /var/log/php/errors.log

## Deployment steps
# run composer for events app
RUN composer install --optimize-autoloader --no-dev
# run composer for personalizedflyer app
RUN cd personalizedflyer
RUN composer install --optimize-autoloader --no-dev
RUN cd ..
# give scripts execute permissions
RUN chmod +x /var/www/docker/run.sh

EXPOSE 80
ENTRYPOINT ["/var/www/docker/run.sh"]