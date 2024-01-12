<?php
    session_start();
    require_once('../modelo/modelo.php');
    require_once('../includes/funciones.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = recoge("name");
        $lastname = recoge("lastname");
        $email = recoge("email");
        $password = recoge("password");
        $passwordRepeat = recoge("passwordRepeat");
        if ($_FILES["img"]["error"] == UPLOAD_ERR_OK) {
            $photo = $_FILES["img"]["name"];
            $tamBytes = $_FILES["img"]["size"];
        }

        if ($email == '' || $password == '' || $passwordRepeat == '') {
            $_SESSION['error'] = '<p>Las casillas con * son obligatorias</p>';
            header("Location: ../alta.php");
        }

        if (!str_contains($email, '@') || !str_contains($email, '.')) {
            $_SESSION['error'] = '<p>Email invalido</p>';
            header("Location: ../alta.php");
        }

        if (existeUsuario($email)) {
            $_SESSION['error'] = '<p>Email registrado</p>';
            header("Location: ../alta.php");
        }

        if ($password != $passwordRepeat) {
            $_SESSION['error'] = '<p>Las contraseñas no coinciden</p>';
            header("Location: ../alta.php");
        }

        if ($_FILES["img"]["error"] == UPLOAD_ERR_OK) {
            if ($_FILES["img"]["size"] < 1000000) {
                $ruta_subida = "../bbdd/";
                $res = move_uploaded_file($_FILES["img"]["tmp_name"], $ruta_subida . $_FILES["img"]["name"]);

                if ($res) {
                    unset($_SESSION["errorImg"]);
                } else {
                    $_SESSION["errorImg"] = "<p>Error al guardar fichero</p>";
                }
            } else {
                $_SESSION["errorImg"] = "<p>Tamaño imagen demasiado grande</p>";
                $_SESSION["dataOK"] = false;
            }
        }

        const $user = new User;


    }