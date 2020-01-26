<?php

include "Coins.php";

function save_file($fich, $var) {
    if(file_exists($fich))
        echo "El Archivo $fich se ha modificado\n";
    else
        echo "El Archivo $fich se ha creado\n";

    if($fd = fopen($fich, "w+"))
    {
        if(fwrite($fd, $var))
            echo "Se ha escrito correctamente\n";
        else
            echo "Ha habido un problema de escritura\n";

        fclose($fd);
        echo "$fich cerrado correctamente\n";
    }
}


// Devuelve: array de 'Currency'
function fillCurrency($obj) {       // FIXME

    $actCurrencies = array();
    foreach ($obj->result as $value)
    {
//        echo "\n\n$i:\n";
        if ($tag = $value->Market->MarketCurrency)
        {}
        else
        {
            $tag = NULL;
            echo "ERROR: No hay 'tag' en el JSON\n";
        }

        if ($name = $value->Market->MarketCurrencyLong)
        {}
        else
        {
            $name = NULL;
//            echo "ERROR: No hay 'name' en el JSON\n";
        }

        if ($base = $value->Market->BaseCurrency)
        {}
        else
        {
            $base = NULL;
            echo "ERROR: No hay 'base' en el JSON\n";
        }

        if ($date = $value->Market->Created)
        {}
        else
        {
            $date = NULL;
//            echo "ERROR: No hay 'date' en el JSON\n";
        }

        if ($min = $value->Market->MinTradeSize)
        {}
        else
        {
            $min = NULL;
//            echo "ERROR: No hay 'min' en el JSON\n";
        }

        $active = $value->Market->IsActive;

        if ($high = $value->Summary->High)
        {}
        else
        {
            $high = NULL;
//            echo "ERROR: No 'high'\n";

        }

        if ($low = $value->Summary->Low)
        {}
        else
        {
            $low = NULL;
//            echo "ERROR: No 'low'\n";

        }

        if ($last = $value->Summary->Last)
        {}
        else
        {
            $last = NULL;
//            echo "ERROR: No 'last'\n";

        }

        if ($bid = $value->Summary->Bid)
        {}
        else
        {
            $bid = NULL;
//            echo "ERROR: No 'bid'\n";

        }

        if ($ask = $value->Summary->Ask)
        {}
        else
        {
            $ask = NULL;
//            echo "ERROR: No 'ask'\n";

        }

        if ($volume = $value->Summary->Volume)
        {}
        else
        {
            $volume = NULL;
//            echo "ERROR: No 'volume'\n";

        }

        if ($volumeBase = $value->Summary->BaseVolume)
        {}
        else
        {
            $volumeBase = NULL;
//            echo "ERROR: No 'volumeBase'\n";

        }

        if ($bOrds = $value->Summary->OpenBuyOrders)
        {}
        else
        {
            $bOrds = NULL;
//            echo "ERROR: No 'bOrds'\n";

        }

        if ($sOrds = $value->Summary->OpenSellOrders)
        {}
        else
        {
            $sOrds = NULL;
//            echo "ERROR: No 'sOrds'\n";

        }

        if ($prevDay = $value->Summary->PrevDay)
        {}
        else
        {
            $prevDay = NULL;
//            echo "ERROR: No 'prevDay'\n";

        }

        if ($time = $value->Summary->TimeStamp)
        {}
        else
        {
            $time = NULL;
//            echo "ERROR: No 'time'\n";

        }

        $actCurrencies[] = new Currency($tag, $name, $base, $date, $min, $active, $high, $low, $last, $bid, $ask,
                                        $volume, $volumeBase, $bOrds, $sOrds, $prevDay, $time);
    }

    return $actCurrencies;
}

// Parametros: - $money: objeto de tipo Coins
function print_coins($money, $param = NULL, $max = NULL) {
    // Para pruebas imprimir dos o tres
    // Para final imprimir todas
    if ($money->getN())
    {
        if (!$max)
            $max = $money->getN();

        if ($param)
        {
            if ($param == 'tag')
            {
                for ($i = 0; $i < $max; $i++) {
                    if ($i % 4 == 3)
                        echo "\t[" . $money->coins[$i]->tag . "-" . $money->coins[$i]->base . "]\n";
                    else
                    {
                        if ($i % 4 == 0)
                            echo "\t";
                        echo "\t[" . $money->coins[$i]->tag . "-" . $money->coins[$i]->base . "]\t";
                    }
                }
            }
            else
            {
                for ($i = 0; $i < $max; $i++) {
                    if ($i % 4 == 3)
                        echo "\t[" . $money->coins[$i]->tag . "-" . $money->coins[$i]->base . "]: " . $money->coins[$i]->$param . "\n";
                    else
                    {
                        if ($i % 4 == 0)
                            echo "\t";
                        echo "\t[" . $money->coins[$i]->tag . "-" . $money->coins[$i]->base . "]: " . $money->coins[$i]->$param . "\t";
                    }
                }

            }

        }

        else
            for ($i = 0; $i < $max; $i++)
                print_r($money->coins);


        echo "\n\tTotal: " . $money->getN() . "\n\n";
    }
    return;
}

// Separa entre monedas activas e inactivas
// Parametros:  - $money: objeto tipo Coins
//              - $act: referencia a objeto tipo Coins
//              - $nact: idem
function is_active($money, &$act, &$nact) {
    if ($money->getN())
    {
        foreach ($money->coins as $item)
        {
            if ($item->active)
                $act->coins[] = $item;
            else
                $nact->coins[] = $item;
        }
    }
    return;
}

// Devuelve: objeto Coins
function search($money, $atr, $value, $mod = false) {
    if ($money->getN())
        return order($money->search($atr, $value, $mod), $atr);
//        return new Coins($money->search($atr, $value));
    else
        return;
}

function clean_last(&$money) {
    foreach ($money->coins as $item)
    {
        $aux = (string)$item->last;
        var_dump($aux);
    }
}
// Separa las monedas entre cada uno de los mercados (BTC, UTH, USD, USDT)
function order_base($money, &$btc, &$eth, &$usd, &$usdt) {
    if ($money->getN())
    {
        foreach ($money->coins as $item)
        {
            switch ($item->base)
            {
                case 'BTC':
                    $btc->coins[] = $item;
                    break;

                case 'ETH':
                    $eth->coins[] = $item;
                    break;

                case 'USD':
                    $usd->coins[] = $item;
                    break;

                case 'USDT':
                    $usdt->coins[] = $item;
                    break;

                default:
                    echo "ERROR: No corresponde a ningun mercado";
                    break;

            }
        }
    }
    return;
}

// Ordenar de menor a mayor y viceversa
// $mod = true (defecto) -> menor a mayor / alfabeticamente
// $mod = false -> mayor a menor / alfabeticamente inverso
// Devuelve: objeto Coins
function order($money, $atr, $mod = true) {
    if ($money->getN() > 1)
    {
        // Crear array de tags
        foreach ($money->coins as $item) {
            $arr[] = $item->$atr;
        }
        // Ordenar array de menor a mayor (alfabeticamente)
        if ($mod)
        {
            if (!sort($arr))
                echo "ERROR: order(): no se ha ordenado el array (lin-374)";
        }
        else
            if (!rsort($arr))
                echo "ERROR: order(): no se ha ordenado el array (lin-378)";

        // Crear array de Currency ordenado
        $ret = new Coins();
        foreach ($arr as $item) {
            // La siguiente condicion es necesaria para que no se repitan
            // $tagsOrd tiene elementos repetidos
            if ($ret->coins == NULL || $ret->coins[$ret->getN() - 1]->$atr != $item)
            {
                foreach ($money->search($atr, $item)->coins as $search) {
                    $ret->addCoin($search);
                }
            }
        }
        return $ret;
    }
    else
        return $money;
}


