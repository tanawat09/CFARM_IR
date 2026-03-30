FROM nginx:alpine

COPY ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf

# Copy public assets so Nginx can serve static files directly
COPY ./public /var/www/html/public
