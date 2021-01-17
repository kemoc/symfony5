#!/usr/bin/env bash


if [ -z ${DIR+x} ]; then
# Not defined 'DIR'
    RED='\033[0;31m'
    GREEN='\033[0;32m'
    BLUE='\033[0;34m'
    NC='\033[0m'

    DIR=$(CDPATH= cd -- "$(dirname -- "$0")" && pwd)
    . ${DIR}/.settings.sh
else
    echo ""
fi

# eZPublish permissions
echo -e "${GREEN}Set eZ permissions (ACL) ${NC}"
#sudo setfacl -R -m u:www-data:rx ./
${DOCKER_PROJECT_EXEC_ROOT} setfacl -R -m u:${DOCKER_WWW_USER}:rx -m u:'root':rwx ./
${DOCKER_PROJECT_EXEC_ROOT} setfacl -R -m u:${DOCKER_WWW_USER}:rwx var/cache var/logs var/sessions web
# permission for HOST general user
${DOCKER_PROJECT_EXEC_ROOT} setfacl -R -m u:'1000':rwx ./

${DOCKER_PROJECT_EXEC_ROOT} setfacl -dR -m u:${DOCKER_WWW_USER}:rx -m u:'root':rwx ./
${DOCKER_PROJECT_EXEC_ROOT} setfacl -dR -m u:${DOCKER_WWW_USER}:rwx var/cache var/logs var/sessions web
# permission for HOST general user
${DOCKER_PROJECT_EXEC_ROOT} setfacl -dR -m u:'1000':rwx ./
echo -e "${GREEN}DONE${NC}"
