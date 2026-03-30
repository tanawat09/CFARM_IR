FROM nginx:alpine

COPY ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf

# Copy public assets so Nginx can serve static files directly
COPY ./public /var/www/html/public

# Create a symlink for Laravel storage so Nginx can resolve image URLs to the shared volume
RUN rm -rf /var/www/html/public/storage && ln -s /var/www/html/storage/app/public /var/www/html/public/storage
