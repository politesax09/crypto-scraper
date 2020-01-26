#!/bin/bash

# Comprobar provilegios de superusuario
if [ $USER == 'root' ] ; then
    echo "No debes ejecutar este script como \"root\""
    exit 0
fi

# Instalar doker e imagenes
sudo ./docker_install.sh "${USER}"

sudo docker run debian:stable ./php7.4_install.sh