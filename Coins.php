<?php

include 'Currency.php';

class Coins
{
    public $coins = array();   // Array de clase Currency
    public $n;   // Numero de coins

    // Constructor por parametro $coins
    function __construct($curr = NULL)
    {
        $this->coins = $curr;
        $this->updateN();
    }

    function __destruct()
    {
        // TODO: Implement __destruct() method.
    }

    // Parametros:  - $obj: objeto de tipo Currency
    function addCoin($obj) {
        $this->coins[] = clone $obj;
        $this->updateN();
    }

    // Devuelve: objeto Coins
    // Parametros:  - $atr: atributo
    //              - $value: valor del atributo
    //              - $mod: modo
    // $mod indica si se va a buscar un valor exacto, mayor, o menor a $value(incluido)
    // Puede haber varias coincidencias
    function search($atr, $value, $mod = false) {
        $ret = new Coins();
        foreach ($this->coins as $item)
        {

            if ($item->search($atr, $value, $mod))
                $ret->addCoin($item);
//                $ret[] = $item;
        }
        return $ret;
    }

    function getCoins($index) {
        if (!$index)
            return $this->coins;
        elseif ($index >= 0)
            return $this->coins[$index];
        else
            return NULL;
    }

    // Actualiza n por si se ha modificado el array
    function updateN() {
        if (!$this->coins)
            $this->n = 0;
        else
            $this->n = count($this->coins);
    }

    function getN() {
        $this->updateN();
        return $this->n;
    }
}