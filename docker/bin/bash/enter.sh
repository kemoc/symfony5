#!/usr/bin/env bash

DIR=$(CDPATH= cd -- "$(dirname -- "$0")" && pwd)
. ${DIR}/.settings.sh

docker-compose -p ${DOCKER_PROJECT_NAME} exec $@
