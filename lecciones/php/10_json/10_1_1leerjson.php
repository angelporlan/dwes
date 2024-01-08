<?php
    $file = 'bbdd/post_1.json';
    $jsonData = file_get_contents("./{$file}", FILE_USE_INCLUDE_PATH);

    $un_post = json_decode($jsonData);
    // $un_post = json_decode($jsonData, true);
    
    //imprimir el tipo de dato de $un_post
    print "Tipo de dato: ". gettype($un_post);

    //imprimir suelto la fecha y el titulo en castellano
    $fecha = date("d/m/Y", $un_post->date);
    $titulo_es = $un_post->title->es;
    print("<p>Fecha: $fecha</p>");
    print("<p>Titulo en castellano: $titulo_es</p>");

    imprimirPost($un_post);

    function imprimirPost($noticia) {
        echo ("<h2>{$noticia->title->es}</h2>");
        echo ("{$noticia->description->es}");
        echo ("<hr>");
        echo ("<h2>{$noticia->title->en}</h2>");
        echo ("{$noticia->description->en}");
        echo ("<img src='$noticia->image'/ width='300'>");
    }

?>