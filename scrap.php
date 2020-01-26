<?php

    include 'simple_html_dom.php';

    // Devuelve: $html [objeto simple_html_dom]
    // Parametros:  - $url
    //              - $data:
    function curl($url, $data = NULL, $headers = NULL)
    {
        // Iniciar sesion cURL
//        $ch = curl_init($url);
        $ch = curl_init();

        // Configurar opciones cURL
        // No verificar certificado SSL
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // url
        curl_setopt($ch, CURLOPT_URL, $url);
        // Para hacer POST al servidor
        if ($data)
        {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        else
        {
            curl_setopt($ch, CURLOPT_POST, false);
            curl_setopt($ch, CURLOPT_HTTPGET, true);
        }

        $response_headers = array('acces-control-allow-credentials: true',
            'acces-control-allow-headers: X-UserID,X-UserExchanges,X-CSRFToken',
            'acces-control-allow-methods: GET, POST, OPTIONS',
            'acces-control-allow-origin: https://es.tradingview.com',
            'content-encoding: gzip',
            'content-type: application/json; charset=utf-8',
            'date: Sun, 19 Jan 2020 15:02:46 GMT',
            'server: nginx',
            'X-Firefox-Spdy: h2');
        $request_headers = array('Accept: text/plain, */*; q=0.01',
            'Accept-Encoding: gzip, deflate, br',
            'Accept-Language: en-US,en;q=0.5',
            'Connection: keep-alive',
            'Content-Length: 367',
            'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
            'Cookie: _sp_id.cf1a=a693e1a2-a64e-46ad-95c6-426172857031.1577616197.12.1579446164.1579276876.a857d1e9-c372-4771-954f-9afde161a5ee; __utma=226258911.107781650.1577621534.1579276877.1579445501.12; __utmz=226258911.1577655015.3.2.utmcsr=google|utmccn=(organic)|utmcmd=organic|utmctr=(not%20provided); _sp_ses.cf1a=*; __utmb=226258911.9.8.1579446166449; __utmc=226258911; __utmt=1',
            'Host: scanner.tradingview.com',
            'Origin: https://es.tradingview.com',
            'Referer: https://es.tradingview.com/',
            'TE: Trailers',
            'User-Agent: Mozilla/5.0 (X11; Linux x86_64; rv:72.0) Gecko/20100101 Firefox/72.0');
        $headers_bittrex = array('Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
            'Accept-Encoding	gzip, deflate, br',
            'Accept-Language	en-US,en;q=0.5',
            'Connection	keep-alive',
            'Host	global.bittrex.com',
            'TE	Trailers',
            'Upgrade-Insecure-Requests	1',
            'User-Agent	Mozilla/5.0 (X11; Linux x86_64; rv:72.0) Gecko/20100101 Firefox/72.0');

        if ($headers)
            // Seleccionar tipo "application/json"
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//        else
//            curl_setopt($ch, CURLOPT_HTTPHEADER, "");

        // Devolver cadena
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Ejecutar peticion
        $info = curl_exec($ch);

        // Cerrar sesion cURL
        curl_close($ch);

        return $info;
    }

    // Solo para objetos simple_html_dom
    function save_file_dom($var) {
        $fich = "html_page.html";
        if (file_exists($fich))
            echo "Existe $fich\n";
        else
            echo "Creado $fich\n";

//        if($fd = fopen($fich, "a"))
//        {
//            if(fwrite($fd, $var))
//                echo "Se ha escrito en $fich\n";
//            else
//                echo "Error al escribir en $fich\n";
//
//            fclose($fd);
//        }
//        else
//            echo "Error al abrir $fich\n";

        $var->save("$fich");
        return;
    }

//    function save_file($fich, $var) {
//        if(file_exists($fich))
//            echo "El Archivo $fich se ha modificado\n";
//        else
//            echo "El Archivo $fich se ha creado\n";
//
//        if($fd = fopen($fich, "a"))
//        {
//            if(fwrite($fd, $var))
//                echo "Se ha escrito correctamente\n";
//            else
//                echo "Ha habido un problema al crear el archivo\n";
//
//            fclose($fd);
//            echo "$fich cerrado correctamente\n";
//        }
//    }

    function getTag($html) {
        $one = new simple_html_dom();
        $two = new simple_html_dom();
        $three = new simple_html_dom();

        $one = $html->find('div[id=js-screener-container]', 0);
        $two = $one->children(0);
        $three = $html->find('a[class=tv-screener-table__symbol-right-part]', 0)->innertext;
//        $two = $one->find('div[class=tv-screener__content-pane]', 0);
        echo "$one\n";
        echo "$two->plaintext\n";
        echo "$three\n";
        return;
    }

    $postJson = array(
        'filter' => array(array('left' => 'name', 'operation' => 'nempty')),
        'options' => array('lang' => 'es'),
        'symbols' => array('query' => array('types' => ''), 'tickers' => ''),
        'columns' => array("name","close","change","change_abs","high","low","volume","Recommend.All","exchange","description","name","subtype","update_mode","pricescale","minmov","fractional","minmove2"),
        'sort' => array('sortBy' => 'name', 'sortOrder' => 'asc'),
        'range' => array(0, 150));
    $json = json_encode($postJson);


//    echo "$json\n";

//    $web = curl("https://es.tradingview.com/crypto-screener/");
//    $res1 = curl("https://es.tradingview.com/market/shopconf/", NULL);
//    $res2 = curl("https://scanner.tradingview.com/crypto/metainfo", NULL);
//    $web = curl("https://scanner.tradingview.com/crypto/scan", $json);
//    $aux = json_decode($web, true);

//    $web = new simple_html_dom();
//    $web = curl("https://global.bittrex.com/api/v2.0/pub/Markets/GetMarketSummaries", NULL, NULL);

//    $one = $web->find('table[class=common-table market-summaries-table]', 0);
//    print_r($web);

//    save_file($web);
//    getTag($web);
//    echo $web;

