<?php


//EJEMPLO 1. UN ARRAY CON UN ELEMENTO
$persona = array(
    "nombre" => "Juan",
    "email" => "juan@test.com",
    "telefono" => "600111111"
);


//Conviero el array a json. Le añado el paramereo de formato bonito. No obligatorio
$json_persona = json_encode($persona, JSON_PRETTY_PRINT);