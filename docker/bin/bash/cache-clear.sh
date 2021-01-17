#!/usr/bin/env bash

DIR=$(CDPATH= cd -- "$(dirname -- "$0")" && pwd)
. ${DIR}/.settings.sh

# Regenerate autoloads
#echo "eZPublish legacy regenerate autoloads \c"
#${DOCKER_PROJECT_EXEC} php bin/php/ezpgenerateautoloads.php
#echo "${GREEN}DONE${NC}"

SYMFONY_ENV_X=""

while [[ $# -gt 0 ]]
do
key="$1"

case $key in
    -e|--env)
    SYMFONY_ENV_X="$2"
    shift # past argument
    shift # past argument
    break;;
    -e=*|--env=*)
    SYMFONY_ENV_X="${key#*=}"
    shift # past argument=value
    break;;
    *)    # unknown option
    shift # past argument
    break;;
esac
done

# Clear cache
echo -e "${GREEN}Clear cache: ${NC}"
if [[ $SYMFONY_ENV_X ]]; then
  ${DOCKER_API_EXEC} php bin/console ca:c -e $SYMFONY_ENV_X
else
  ${DOCKER_API_EXEC} php bin/console ca:c
fi
echo -e "${GREEN}DONE${NC}"
