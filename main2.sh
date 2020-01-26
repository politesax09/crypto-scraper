#!/bin/bash

#. /home/adrian/PhpstormProjects/crypto-scraper/new_console.sh
#. new_console.sh

function new_console() {
    # Buscar nueva consola creada
    for i in $( ls /dev/pts ) ; do
        console=("${console[@]}" "${i}")
    done
    newConsole=${console[-2]}
    echo "${newConsole}"
    return 0
}
# ==========================================================

gnome-terminal

console=$( new_console )

sleep 3
echo -e "\nHola soy main2.sh" 1>/dev/pts/${console}

exit