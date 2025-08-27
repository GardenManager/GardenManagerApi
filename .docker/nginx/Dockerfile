FROM nginx:mainline-alpine
COPY ./.docker/nginx/conf.d/default.conf /etc/nginx/conf.d/default.conf
COPY --link ./public /app/public
