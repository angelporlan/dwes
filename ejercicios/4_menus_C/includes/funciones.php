<?php

require_once('../modelo/modelo.php');

//######## FUNCION RECOGER
//Recoge los datos de los formularios y los depura para no meter código malicioso
//Esta finción no comprueba errores.
//ENTRADA: el nombre del campo a recoger, indicado por el atributo 'name' del formulario
//SALIDA: el valor del campo o null si está vacio
function recoge($var)
{
    if (isset($_REQUEST[$var])) {
        if ($_REQUEST[$var] != "") {
            $tmp = trim(htmlspecialchars(strip_tags($_REQUEST[$var])));
            return $tmp;
        }
    }
    return null;
}

function existeUsuario($email) {
    $lista_usuarios = [];
    $file = '../bbdd/data.json';   

    $jsonData = file_get_contents("./{$file}", FILE_USE_INCLUDE_PATH);
    $lista_usuarios = json_decode($jsonData);

    foreach ($lista_usuarios as $usuario) {
        if ($usuario->email == $email) {
            return true;
        }
    }
    return false;
}

function findAndRetrieveUser($email, $password) {
    $lista_usuarios = [];
    $file = '../bbdd/data.json';   

    $jsonData = file_get_contents("./{$file}", FILE_USE_INCLUDE_PATH);
    $lista_usuarios = json_decode($jsonData);

    foreach ($lista_usuarios as $user) {
        if ($user->email == $email && password_verify($password, $user->password)) {
            return $user;
        }
    }
    return null;
}