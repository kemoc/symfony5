#!/usr/bin/env bash

DIR=$(CDPATH= cd -- "$(dirname -- "$0")" && pwd)
. ${DIR}/.settings.sh

${DOCKER_NGINX_EXEC_ROOT} bash
