#!/bin/bash -e

#. /usr/local/bin/docker-php-entrypoint
set -e

if [ "$HOST_USER" ]; then
  OWNER=$(echo $HOST_USER | cut -d: -f1)
  GROUP=$(echo $HOST_USER | cut -d: -f2)
else
  OWNER=$(stat -c '%u' $PROJECTMAPPINGFOLDER)
  GROUP=$(stat -c '%g' $PROJECTMAPPINGFOLDER)
fi

if [ "$OWNER" != "0" ]; then
  usermod -o -u $OWNER www-data
  groupmod -o -g $GROUP www-data
fi

# Create .composer in advance and set the permissions
if [ -d "/var/www/.composer" ]; then
  echo "OK composer"
else
  mkdir -p /var/www/.composer
fi

chown -R www-data:www-data /var/www/.composer

# give the good permissions to www-data in the container and remove the cache on start
if [ -d "$PROJECTMAPPINGFOLDER/var" ]; then
    chown -R www-data:www-data "$PROJECTMAPPINGFOLDER/var"
fi

if [ -d "$PROJECTMAPPINGFOLDER/var/cache" ]; then
    rm -rf "$PROJECTMAPPINGFOLDER/var/cache/*"
fi

if [ -d "$PROJECTMAPPINGFOLDER/var/log" ]; then
    rm -rf "$PROJECTMAPPINGFOLDER/var/log/*"
fi

chmod -R o=rx "$PROJECTMAPPINGFOLDER"

#composer install
#chown -R www-data:www-data "$PROJECTMAPPINGFOLDER"
#chown -R www-data:www-data /var/www/.composer

exec "$@"
