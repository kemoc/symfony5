#!/usr/bin/env bash

DIR=$(CDPATH= cd -- "$(dirname -- "$0")" && pwd)
. ${DIR}/.settings.sh

#${DOCKER_APP_EXEC_ROOT} mysql -u ezuser --password=qaz12qaz--4 -h mariadb transactions < "${9:-/dev/stdin}"
${DOCKER_API_EXEC_ROOT} mysql -u ezuser --password=qaz12qaz -h mariadb project < "${9:-/dev/stdin}"
