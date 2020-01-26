
function new_console() {
    # Buscar nueva consola creada
    for i in $( ls /dev/pts ) ; do
        console=("${console[@]}" "${i}")
    done
    newConsole=${console[-2]}
    echo "${newConsole}"
    return 0
}