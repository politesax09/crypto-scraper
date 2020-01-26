#!/bin/php7.4
<?php

    include 'scrap.php';

    $postJson = array(
        'filter' => array(array('left' => 'name', 'operation' => 'nempty')),
        'options' => array('lang' => 'es'),
        'symbols' => array('query' => array('types' => ''), 'tickers' => ''),
        'columns' => array("name","close","change","change_abs","high","low","volume","Recommend.All","exchange","description","name","subtype","update_mode","pricescale","minmov","fractional","minmove2"),
        'sort' => array('sortBy' => 'name', 'sortOrder' => 'asc'),
        'range' => array(0, 150));
    $json = json_encode($postJson);

    $reqHeaders = array('Accept	text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
        'Accept-Encoding	gzip, deflate, br',
        'Accept-Language	en-US,en;q=0.5',
        'Connection	keep-alive',
        'Content-Length	368',
        'Content-Type	application/x-www-form-urlencoded; charset=UTF-8',
        'Host	scanner.tradingview.com',
        'Upgrade-Insecure-Requests	1',
        'User-Agent	Mozilla/5.0 (X11; Linux x86_64; rv:72.0) Gecko/20100101 Firefox/72.0');

    $web = curl("https://scanner.tradingview.com/crypto/scan", $json, $reqHeaders);
    print_r($web);