Sandbox to develop web attacks
- flask: web server serving the html directory
- php8-fpm: web server to serve the html directory
- webserver: standalone web server container
- self_signed_cert.sh creates the certificates
- docker-compose.yaml: creates a nginx frontend with a php8-fpm backend using the html/ volume
