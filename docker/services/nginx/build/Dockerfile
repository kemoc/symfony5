FROM nginx:1.18
MAINTAINER Radek Z

ENV PROJECTMAPPINGFOLDER="/var/www/project"

# Update sources
RUN apt update -y
RUN apt install -y apt-utils

RUN apt install -y vim nano wget

RUN apt install -y libssl-dev
RUN apt install -y curl libcurl4-openssl-dev
RUN apt install -y bash

RUN cp /etc/nginx/conf.d/default.conf /etc/nginx/conf.d/default.conf.bak

WORKDIR /etc/nginx/

RUN rm -rf /var/lib/apt/lists/* /tmp/*