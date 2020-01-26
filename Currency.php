<?php


class Currency
{
    /* Atributos */
    // Caracteristicas generales
    public $tag;    // Etiqueta de la divisa
    public $name;    // Nombre de la divisa
    public $base;   // Etiqueta de la divisa base
    public $date;    // Fecha de creacion
    public $min;    // Cantidad minima de transaccion
    public $active;    // Activa/Inactiva

    // Precios
    public $high;    // Mas alto
    public $low;     // Mas bajo
    public $last;    // Ultimo
    public $bid;     // Oferta ultima orden
    public $ask;     // Demanda ultima orden

    // Volumen
    public $volume;      // Volumen del mercado
    public $volumeBase;      // Volumen de base

    public $buyOrders;    // Ordenes de compra y de venta abiertas
    public $sellOrders;
    public $prevDay;     // Precio de cierre del ultimo dia

    public $current;     // Ultima fecha de actualizacion

    /* Metodos */

    function __construct($tag = NULL, $name = NULL, $base = NULL, $date = NULL, $min = NULL, $active = NULL,
                         $high = NULL, $low = NULL, $last = NULL, $bid = NULL, $ask = NULL, $vol = NULL,
                         $volBase = NULL, $bOrds = NULL, $sOrds = NULL, $prevDay = NULL, $curr = NULL)
    {
        $this->tag = $tag;
        $this->name = $name;
        $this->base = $base;
        $this->date = $date;
        $this->min = $min;
        $this->active = $active;
        $this->high = $high;
        $this->low = $low;
        $this->last = $last;
        $this->bid = $bid;
        $this->ask = $ask;
        $this->volume = $vol;
        $this->volumeBase = $volBase;
        $this->buyOrders = $bOrds;
        $this->sellOrders = $sOrds;
        $this->prevDay = $prevDay;
        $this->current = $curr;
    }

    function get($atr) {
        switch ($atr)
        {
            case 'tag':
                return $this->tag;
                break;

            case 'name':
                return $this->name;
                break;

            case 'base':
                return $this->base;
                break;

            case 'date':
                return $this->date;
                break;

            case 'min':
                return $this->min;
                break;

            case 'active':
                return $this->active;
                break;

            case 'high':
                return $this->high;
                break;

            case 'low':
                return $this->low;
                break;

            case 'last':
                return $this->last;
                break;

            case 'bid':
                return $this->bid;
                break;

            case 'ask':
                return $this->ask;
                break;

            case 'volume':
                return $this->volume;
                break;

            case 'volumeBase':
                return $this->volumeBase;
                break;

            case 'buyOrders':
                return $this->buyOrders;
                break;

            case 'sellOrders':
                return $this->sellOrders;
                break;

            case 'prevDay':
                return $this->prevDay;
                break;

            case 'current':
                return $this->current;
                break;

            case '':
                echo "ERROR: Seleccionar un atributo";
                break;

            default:
                echo "ERROR: Atributo no valido\n";
        }
    }

    function set($atr, $value) {
        switch ($atr)
        {
            case 'tag':
                $this->tag = $value;
                break;

            case 'name':
                $this->name = $value;
                break;

            case 'base':
                $this->base = $value;
                break;

            case 'date':
                $this->date = $value;
                break;

            case 'min':
                $this->min = $value;
                break;

            case 'active':
                $this->active = $value;
                break;

            case 'high':
                $this->high = $value;
                break;

            case 'low':
                $this->low = $value;
                break;

            case 'last':
                $this->last = $value;
                break;

            case 'bid':
                $this->bid = $value;
                break;

            case 'ask':
                $this->ask = $value;
                break;

            case 'volume':
                $this->volume = $value;
                break;

            case 'volumeBase':
                $this->volumeBase = $value;
                break;

            case 'buyOrders':
                $this->buyOrders = $value;
                break;

            case 'sellOrders':
                $this->sellOrders = $value;
                break;

            case 'prevDay':
                $this->prevDay = $value;
                break;

            case 'current':
                $this->current = $value;
                break;

            case '':
                echo "ERROR: Seleccionar un atributo";
                break;

            default:
                echo "ERROR: Atributo no valido\n";
        }
        return;
    }

    // Devuelve:    - booleano
    // Parametros:  - $atr: atributo
    //              - $value: valor del atributo
    //              - $mod: modo
    // $mod indica si se va a buscar un valor exacto, mayor, o menor a $value(incluido)
    function search($atr, $value, $mod = false) {
        if ($mod == '-')
        {
            if ($this->$atr <= $value)
                return true;
            else
                return false;
        }
        elseif ($mod == '+')
        {
            if ($this->$atr >= $value)
                return true;
            else
                return false;
        }
        else
        {
            if ($this->$atr == $value)
                return true;
            else
                return false;
        }
    }

    function __destruct()
    {
        // TODO: Implement __destruct() method.
    }

}