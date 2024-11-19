#!/bin/sh

echo "Recuerda que este script debes ejecutarlo DESPUES de arrancar contenedores con: docker compose up -d o docker-compose up -d"
docker exec ml_1 chown -R www-data:www-data /var/www/html/imgs
echo "Usuario de la carpeta 'imgs' en el contenedor es ahora www-data"
