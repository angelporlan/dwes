<?php

session_start();
require_once('../modelo/modelo.php');
require_once('../includes/funciones.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = recoge("email");
    $password = recoge("password");

    if ($email == null || $password == null) {
        $_SESSION['errorLogin'] = "<p class='error'>Email y Contraseña obligario";
        header("Location: ../login.php");
        exit();
    }

    // if (!existeUsuario($gmial)) {
    //     $_SESSION['errorLogin'] = "<p>Email no registrado";
    //     header("Location: ../login.php");
    //     exit();
    // }

    $user = findAndRetrieveUser($email, $password);

    if ($user == null) {
        header("Location: ../login.php");
        $_SESSION['errorLogin'] = "<p class='error'>Email o Contraseña incorrecto";
        exit();
    }

    $_SESSION['userLogin'] = $user;
    header("Location: ../index.php");
}