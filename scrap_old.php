#!/bin/php7.4
<?php

    include './simple_html_dom.php';

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
        $info = new simple_html_dom();
//        $info->load($str);
        return $info;
    }

    function getTag($html) {
        // Crear objeto tipo simple_html_dom
//        $html = new simple_html_dom();
//        $html->load(str);

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

        $tag = $html->find('div#js-screener-container');
        echo $tag;
    }

    $web = curl("https://es.tradingview.com/crypto-screener/");
    getTag($web);
//    echo $web;