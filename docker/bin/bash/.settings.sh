#!/usr/bin/env bash

RED='\033[0;31m'
GREEN='\033[0;32m'
BLUE='\033[0;34m'
NC='\033[0m'

DOCKER_ENV="dev"

# ("dev|prod")
SYMFONY_ENV="dev"

DOCKER_API_PATH=/var/www/project
DOCKER_PROJECT_NAME=cobiro-task

DOCKER_API_EXEC_ROOT="docker-compose -p ${DOCKER_PROJECT_NAME} exec api"
DOCKER_API_EXEC="docker-compose -p ${DOCKER_PROJECT_NAME} exec --user www-data api"

DOCKER_NGINX_EXEC_ROOT="docker-compose -p ${DOCKER_PROJECT_NAME} exec nginx"
DOCKER_NGINX_EXEC="docker-compose -p ${DOCKER_PROJECT_NAME} exec --user www-data nginx"

DOCKER_DAEMON_START="docker-compose -p ${DOCKER_PROJECT_NAME} up -d"
#DOCKER_DAEMON_START="docker-compose -p ${DOCKER_PROJECT_NAME} up -d --force-recreate"
DOCKER_DAEMON_STOP="docker-compose -p ${DOCKER_PROJECT_NAME} stop"
#docker-compose -p  cobiro-task stop

DOCKER_BUILD="docker-compose -p ${DOCKER_PROJECT_NAME} build --pull"
# docker-compose -p cobiro-task build --pull api
DOCKER_REBUILD="docker-compose -p ${DOCKER_PROJECT_NAME} build --pull --no-cache"

DOCKER_HTTPD_EXEC_ROOT="docker-compose -p ${DOCKER_PROJECT_NAME} exec httpd"
