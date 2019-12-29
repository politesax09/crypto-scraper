#!/bin/bash

# Comprobar provilegios de superusuario
if [ $USER != 'root' ] ; then
    echo "Debe ser ejecutado como \"root\" "
    exit 0
fi

# Descargar claves
wget https://download.docker.com/linux/debian/gpg -O- | sudo apt-key add

# Crear fichero de repositorios docker y anadir el repositorio
echo "deb [arch=amd64] https://download.docker.com/linux/debian $(lsb_release -sc) stable" | tee /etc/apt/sources.list.d/docker.list

# Actualizar
apt-get update

# Instalar paquetes necesarios
apt install -y docker-ce docker-ce-cli containerd.io

# Anadir usuario al grupo docker
adduser USUARIO docker

# Probar instalacion docker
docker run hello-world

# TODO: Mensaje final de instalacion exitosa (colores)
