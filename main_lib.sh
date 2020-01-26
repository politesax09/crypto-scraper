
function menu_great_small() {
    case ${mode} in
        '-')
            retGrSm='-'
            return 0
            ;;
        '+')
            retGrSm='+'
            return 0
            ;;
        '')
            retGrSm=false
            return 0
            ;;
        *)
            echo -e "ERROR: [modo] no valido\n"
            return 1
            ;;
    esac
}



function menu_order() {
#    while :
#    do
        echo -e "\e[1;33mCrypto Scraper - Menú Ordenar\e[0m"
        echo -e "Sintaxis: '[parametro] [modo]'"
        echo -e "\t- modo: +: De mayor a menor, -: De menor a mayor (por defecto)"
        echo -e "Parametro de ordenacion:"
        echo -e "\t- tag: Etiqueta"
        echo -e "\t- name: Nombre"
        echo -e "\t- date: Fecha de creacion"
        echo -e "\t- min: Cantidad minima de transaccion"
        echo -e "\t- high: Mayor del dia"
        echo -e "\t- low: Menor precio del dia"
        echo -e "\t- last: Ultimo precio"
        echo -e "\t- bid: Precio de oferta"
        echo -e "\t- ask: Precio de demanda"
        echo -e "\t- volume: Volumen del mercado"
        echo -e "\t- volumebase: Volumen base del mercado"
        echo -e "\t- buyords: Ordenes de compra en curso"
        echo -e "\t- sellords: Ordenes de venta en curso"
        echo -e "\t- prevday: Precio de cierre del dia anterior"
        echo -n "Opción >> "
        read param mode
        echo

        retFunc='order'
        menu_great_small
        if [ ! $? ]; then
            return 1
        fi

        case ${param} in
            'tag')
                retParam='tag'
                return 0
                ;;
            'name')
                retParam='name'
                return 0
                ;;
            'date')
                retParam='date'
                return 0
                ;;
            'min')
                retParam='min'
                return 0
                ;;
            'high')
                retParam='high'
                return 0
                ;;
            'low')
                retParam='low'
                return 0
                ;;
            'last')
                retParam='last'
                return 0
                ;;
            'bid')
                retParam='bid'
                return 0
                ;;
            'ask')
                retParam='ask'
                return 0
                ;;
            'volume')
                retParam='volume'
                return 0
                ;;
            'volumebase')
                retParam='volumeBase'
                return 0
                ;;
            'buyords')
                retParam='buyOrds'
                return 0
                ;;
            'sellords')
                retParam='sellOrds'
                return 0
                ;;
            'prevday')
                retParam='prevDay'
                return 0
                ;;
            *)
                echo -e "ERROR: [parametro] no valido\n"
                return 1
                ;;
        esac
#
#    done
}

function menu_search() {
  # TODO: En $value de tipo numerico buscar valor exacto, mayor y menor que el valor
#    while :
#    do
        echo -e "\e[1;33mCrypto Scraper - Menú Buscar\e[0m"
        echo -e "Sintaxis: '[parametro] [valor] [modo]'"
        echo -e "\t- modo: +: Mayores que [valor], -: Menores que [valor] (por defecto)"
        echo -e "\t(solo para parametros numericos)"
        echo -e "Parametro de busqueda:"
        echo -e "\t- tag: Etiqueta"
        echo -e "\t- name: Nombre"
        echo -e "\t- date: Fecha de creacion"
        echo -e "\t- min: Cantidad minima de transaccion"
        echo -e "\t- high: Mayor del dia"
        echo -e "\t- low: Menor precio del dia"
        echo -e "\t- last: Ultimo precio"
        echo -e "\t- bid: Precio de oferta"
        echo -e "\t- ask: Precio de demanda"
        echo -e "\t- volume: Volumen del mercado"
        echo -e "\t- volumebase: Volumen base del mercado"
        echo -e "\t- buyords: Ordenes de compra en curso"
        echo -e "\t- sellords: Ordenes de venta en curso"
        echo -e "\t- prevday: Precio de cierre del dia anterior"
        echo -n "Opción >> "
        read param retValue mode
        echo

        retFunc='search'
        menu_great_small
        if [ ! $? ]; then
            return 1
        fi

        case ${param} in
            'tag')
                retParam='tag'
                return 0
                ;;
            'name')
                retParam='name'
                return 0
                ;;
            'date')
                retParam='date'
                return 0
                ;;
            'min')
                retParam='min'
                return 0
                ;;
            'high')
                retParam='high'
                return 0
                ;;
            'low')
                retParam='low'
                return 0
                ;;
            'last')
                retParam='last'
                return 0
                ;;
            'bid')
                retParam='bid'
                return 0
                ;;
            'ask')
                retParam='ask'
                return 0
                ;;
            'volume')
                retParam='volume'
                return 0
                ;;
            'volumebase')
                retParam='volumeBase'
                return 0
                ;;
            'buyords')
                retParam='buyOrds'
                return 0
                ;;
            'sellords')
                retParam='sellOrds'
                return 0
                ;;
            'prevday')
                retParam='prevDay'
                return 0
                ;;
            *)
                echo -e "ERROR: [parametro] no valido\n"
                return 1
                ;;
        esac
#
#    done
}

#fucntion menu_select() {
#
#}

function menu() {
    while :
    do
        echo -e "\e[1;33mCrypto Scraper - Menú Principal\e[0m"
        echo -e "\to: Ordenar\n\tb: Buscar\n\ts: Seleccionar\n\t: Mostrar\n\tq: Salir"
        echo -n "Opción >> "
        read opt
        echo

        case ${opt} in
            'o')
                menu_order
                ret=("${retFunc}" "${retParam}" "${retGrSm}")
                ;;
            'b')
                menu_search
                ret=("${retFunc}" "${retParam}" "${retValue}" "${retGrSm}")
                ;;
            's')
                menu_select
                ;;
            'm')
                retFunc='show'
                unset retParam
                unset retValue
                unset retGrSm
                ;;
            'f')
                retFunc='current'
                unset retParam
                unset retValue
                unset retGrSm
                ;;
            'q')
                exit
                ;;
            *)
            echo -e "\e[1;31m[ERROR]: Opción incorrecta\e[0m"
                ;;
        esac

        if [ "${opt}" != 'q' ]; then
            echo "${ret[*]}"
            ./index.php ${ret[*]}
        fi


    done
}

# TODO: Incluir libreria colores fabi