#!/usr/bin/env bash

RED='\033[0;31m'
GREEN='\033[0;32m'
BLUE='\033[0;34m'
NC='\033[0m'

DIR=$(CDPATH= cd -- "$(dirname -- "$0")" && pwd)
. ${DIR}/.settings.sh

# Permissions
#echo "Set dir www permission (user: ${DOCKER_WWW_USER}:${DOCKER_WWW_USER}) ${DOCKER_PROJECT_PATH}/var/\c"
#${DOCKER_PROJECT_EXEC_ROOT} chmod -R ugo+rx /var/www
#${DOCKER_API_EXEC_ROOT} chown -R ${DOCKER_WWW_USER}:${DOCKER_WWW_USER} ${DOCKER_PROJECT_PATH}/var/
#echo "Set dir ${GREEN}DONE${NC}"

# Composer install
echo -e "${GREEN}Install Composer vendors: ${NC}"
${DOCKER_API_EXEC} composer clear-cache
${DOCKER_API_EXEC} composer install
${DOCKER_API_EXEC} composer info
echo -e "${GREEN}DONE${NC}"


