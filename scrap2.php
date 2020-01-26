#!/bin/php7.4

<?php

    include 'simple_html_dom.php';

    function curl() {
        $url = 'http://superdeals.aliexpress.com/en?spm=2114.11010108.21.1.v65LIL';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_URL, $base);
        curl_setopt($curl, CURLOPT_REFERER, $base);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $str = curl_exec($curl);
        curl_close($curl);

        $html = new simple_html_dom();
        $html->load($str);
        return $html;
    }

    function getTag($html) {
        // Guarda la etiqueta de la divisa
//        $tag = $html->find('div[class=tv-site-widget__body tv-screener__standalone-wrap]
//                                    div[id=js-screener-container]
//                                        div[class=tv-screener__content-pane]
//                                            table
//                                                tbody
//                                                    tr
//                                                        td[class=tv-screener-table__cell tv-screener-table__cell--left]
//                                                            div[tv-screener-table__symbol-right-part]
//                                                                div[class=tv-screener-table__symbol-right-part]
//                                                                    a[tv-screener__symbol apply-common-tooltip]');


//        $tag = $html->find('div[class=tv-site-widget__body tv-screener__standalone-wrap]
//                            div[id]
//                            div[class=tv-screener__content-pane]');

//        $tag = $html->find('div.tv-screener-table__symbol-right-part');
//        $tag = $html->find('div[class=tv-screener-table__symbol-right-part]');
//        $tag = $html->find('div[class=tv-screener__content-pane]');

        $tag = $html->find('div');

        if ($tag == null)
            echo "\$tag no existe\n";
        else
            echo "$tag[0]\n";

        return;
    }

//    $html = file_get_html('https://es.tradingview.com/crypto-screener/');
    $html = cur();
    echo $html;
    getTag($html);
