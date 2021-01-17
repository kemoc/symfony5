#!/usr/bin/env bash

DIR=$(CDPATH= cd -- "$(dirname -- "$0")" && pwd)
. ${DIR}/.settings.sh

${DOCKER_API_EXEC_ROOT} mysqldump -u ezuser --password=qaz12qaz--4 -h mariadb project > "${VAR:-/dev/stdout}"
