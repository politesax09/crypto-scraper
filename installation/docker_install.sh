#!/bin/bash

# Comprobar provilegios de superusuario
if [ $USER != 'root' ] ; then
    echo "Debes ser \"root\" para ejecutar este script"
    exit 0
fi

user=$1

# Descargar claves
wget https://download.docker.com/linux/debian/gpg -O- | sudo apt-key add

# Crear fichero de repositorios docker y anadir el repositorio
echo "deb [arch=amd64] https://download.docker.com/linux/debian $(lsb_release -sc) stable" | tee /etc/apt/sources.list.d/docker.list

# Actualizar repositorios
apt-get update

# Instalar paquetes necesarios
apt install -y docker-ce docker-ce-cli containerd.io

# Anadir usuario al grupo docker
adduser "${user}" docker

# Probar instalacion docker
docker run hello-world

# Instalar imagen de debian
docker pull debian:stable

# Instalar imagen de ubuntu
docker pull ubuntu:rolling

# TODO: Mensaje final de instalacion exitosa (colores)
