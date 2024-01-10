<?php

session_start();

require_once('../modelo/modelo.php');
require_once('../includes/funciones.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = recoge("email");
    $password = recoge("pass1");

    if ($email == null or $password == null) {
        $_SESSION["errorLogin"] = "Los campos no pueden estar vacios";
        header("Location: ../login.php");
        return; 
    }

    $user = checkuser($email, $password);

    if ($user == null) {
        $_SESSION["errorLogin"] = "Credenciales inválidas";
        header("Location: ../login.php");
        return; 
    } else {
        unset($_SESSION["errorLogin"]);

        $_SESSION["userObject"] = $user;

        header("Location: ../index.php");
    }
}