#!/bin/bash

# Comprobar provilegios de superusuario
if [ $USER != 'root' ] ; then
    echo "Debes ser \"root\" para ejecutar este script"
    exit 0
fi

# Descargar claves
apt -y install lsb-release apt-transport-https ca-certificates wget
wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg

# Crear fichero de repositorios php y anadir el repositorio
echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/php.list

# Actualizar repostiorios
apt-get update

# Instalar PHP 7.4
apt-get -y install php7.4

# Comprobar instalacion
php -v
