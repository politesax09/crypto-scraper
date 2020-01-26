#!/bin/php7.4

<?php
    // Libreria de funciones de gestion de datos de scraping
    include 'simple_html_dom.php';

    function curl($url) {
        // Iniciar sesion cURL
        $ch = curl_init($url);

        // Configurar opciones cURL
        // Devolver cadena
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // No verificar certificado SSL
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // Extraer pagina html
        $info = curl_exec($ch);

        // Cerrar sesion cURL
        curl_close($ch);
//        var_dump($info);
        return $info;
    }

    function getTag($html) {
        $html = new simple_html_dom();
//        $html->load($str);

        // Guarda la etiqueta de la divisa
//        $tag = $html->find('div[class=tv-site-widget__body]
//                                div[id=js-screener-container]
//                                    div[class=tv-screener__content-pane]
//                                        table
//                                            tbody
//                                                tr
//                                                    td[class=tv-screener-table__cell--left]
//                                                        div
//                                                            div[class=tv-screener-table__symbol-right-part]
//                                                                a', 0);

        // FIXME: Utilizar variables intermedias para acceder a la etiqueta

        $tag = $html->find('div#tv-screener-table__symbol-right-part', 0);
//        echo "$tag\n";
        echo $html;
        return;
    }

    $web = curl("https://es.tradingview.com/crypto-screener/");
    getTag($web);
//    echo getTag($web);


