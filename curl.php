#!/bin/php7.4
<?php

    // Definimos la función cURL
    function curl($url) {
        // Inicia sesión cURL
        $ch = curl_init($url);
        // Configura cURL para devolver el resultado como cadena
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        // Configura cURL para que no verifique el peer del certificado dado que nuestra URL utiliza el protocolo HTTPS
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // Establece una sesión cURL y asigna la información a la variable $info
        $info = curl_exec($ch);
        // Cierra sesión cURL
        curl_close($ch);
        // Devuelve la información de la función
        return $info;
    }

    $sitioweb = curl("https://devcode.la");  // Ejecuta la función curl escrapeando el sitio web https://devcode.la and regresa el valor a la variable $sitioweb
    echo $sitioweb;

?>
