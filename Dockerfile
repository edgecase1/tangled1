FROM nginx

COPY nginx.conf /etc/nginx/conf.d/default.conf
COPY test.crt /etc/nginx/
COPY test.key /etc/nginx/

