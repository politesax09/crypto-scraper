#!/bin/php7.4
<?php

include 'scrap_bittrex.php';
include 'scrap.php';

// Parametros: - $arg: segundo argumento pasado al script ($argv[1])
//function clean_args($arg) {
//    for ($i = 0; i != '\0'; $i++)
//    {
//        if ($arg[$i] == ':')
//            // Array de indices
//            $index[] = $i - 1;
//
//    }
//
//}

// Argumentos del script: $argv[0] = index.php, $argv[1] = param 1, etc.

//==============================================================

// Extraccion del fichero json y traduccion
$json = curl("https://global.bittrex.com/api/v2.0/pub/Markets/GetMarketSummaries");
// Guardar json en fichero
save_file('./info/json_bittrex.json', $json);
// Traducir json en array (objeto de stdClass)
$jsonDeco = json_decode($json);

// Convertir objeto devuelto en clase Currency
$coins = fillCurrency($jsonDeco);
// Meterlo en objeto Coins
$crypto = new Coins($coins);

echo "SOY INDEX.PHP\n";
print_r($argv);
echo "$argc";

// Clasificar monedas segun los mercados
$cryptoBTC = new Coins();
$cryptoETH = new Coins();
$cryptoUSD = new Coins();
$cryptoUSDT = new Coins();
order_base($crypto, $cryptoBTC, $cryptoETH, $cryptoUSD, $cryptoUSDT);

// Clasificar en activas/inactivas dentro de cada mercado
// BTC
$actBTC = new Coins();
$inactBTC = new Coins();
is_active($cryptoBTC, $actBTC, $inactBTC);
// ETH
$actETH = new Coins();
$inactETH = new Coins();
is_active($cryptoETH, $actETH, $inactETH);
// USD
$actUSD = new Coins();
$inactUSD = new Coins();
is_active($cryptoUSD, $actUSD, $inactUSD);
// USDT
$actUSDT = new Coins();
$inactUSDT = new Coins();
is_active($cryptoUSDT, $actUSDT, $inactUSDT);

//print_r($argv);
//echo "\n";
//echo $argc;



switch ($argv[1])
{
    case 'order':
        if ($argv[3] == '+')
        {
            $actBTC = order($actBTC, $argv[2], false);
            $inactBTC = order($inactBTC, $argv[2], false);
            $actETH = order($actETH, $argv[2], false);
            $inactETH = order($inactETH, $argv[2], false);
            $actUSD = order($actUSD, $argv[2], false);
            $inactUSD = order($inactUSD, $argv[2], false);
            $actUSDT = order($actUSDT, $argv[2], false);
            $inactUSDT = order($inactUSDT, $argv[2], false);
        }
        else
        {
            $actBTC = order($actBTC, $argv[2]);
            $inactBTC = order($inactBTC, $argv[2]);
            $actETH = order($actETH, $argv[2]);
            $inactETH = order($inactETH, $argv[2]);
            $actUSD = order($actUSD, $argv[2]);
            $inactUSD = order($inactUSD, $argv[2]);
            $actUSDT = order($actUSDT, $argv[2]);
            $inactUSDT = order($inactUSDT, $argv[2]);
        }
        echo "Mercado BTC:\n\tActivas:\n";
        print_coins($actBTC, $argv[2]);
        echo "\tInactivas:\n";
        print_coins($inactBTC, $argv[2]);
        echo "Mercado ETH:\n\tActivas:\n";
        print_coins($actETH, $argv[2]);
        echo "\tInactivas:\n";
        print_coins($inactETH, $argv[2]);
        echo "Mercado USD:\n\tActivas:\n";
        print_coins($actUSD, $argv[2]);
        echo "\tInactivas:\n";
        print_coins($inactUSD, $argv[2]);
        echo "Mercado USDT:\n\tActivas:\n";
        print_coins($actUSDT, $argv[2]);
        echo "\tInactivas:\n";
        print_coins($inactUSDT, $argv[2]);
        break;

    case 'search':
        $cryptoSearch = search($crypto, $argv[2], $argv[3], $argv[4]);
        print_coins($cryptoSearch, $argv[2]);
        break;

    case 'show':
        break;

    case 'current':
        echo "Ultima fecha de actualizacion:\t".  $crypto->coins[0]->current . "\n";
        break;

    default:
        break;
}



