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

# FIXME: No instalar apache si no es necesario
# Instalar PHP 7.4
apt-get -y install php7.4

# Comprobar instalacion
php -v

# Instalar extensiones necesarias
# cURL
apt-get -y install php7.4-curl
# Simple HTML DOM
mkdir -p /tmp/crypto-scraper/sHDOM
cd /tmp/crypto-scraper
wget -t 3 -P /tmp/crypto-scraper/sHDOM https://sourceforge.net/projects/simplehtmldom/files/latest/download
mv /tmp/crypto-scraper/sHDOM/download /tmp/crypto-scraper/sHDOM/sHDOM.zip
unzip -d /tmp/crypto-scraper/sHDOM /tmp/crypto-scraper/sHDOM/sHDOM.zip

# TODO: Posicionar bien el fichero de la libreria de sHDOM
rm -r /tmp/crypto-scraper

# TODO: Mensaje final de instalacion exitosa (colores)
