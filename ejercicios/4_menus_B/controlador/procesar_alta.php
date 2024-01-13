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
            $img = $_FILES["img"]["name"];
            $tamBytes = $_FILES["img"]["size"];
        }

        $_SESSION['name'] = $name;
        $_SESSION['lastname'] = $lastname;
        $_SESSION['email'] = $email;

        if ($email == '' || $password == '' || $passwordRepeat == '') {
            $_SESSION['errorAlta'] = '<p class="error">Las casillas con * son obligatorias</p>';
            header("Location: ../alta.php");
            exit();
        }

        if (!str_contains($email, '@') || !str_contains($email, '.')) {
            $_SESSION['errorAlta'] = '<p class="error">Email invalido</p>';
            header("Location: ../alta.php");
            exit();
        }

        if (existeUsuario($email)) {
            $_SESSION['errorAlta'] = '<p class="error">Email registrado</p>';
            header("Location: ../alta.php");
            exit();
        }

        if ($password != $passwordRepeat) {
            $_SESSION['errorAlta'] = '<p class="error">Las contraseñas no coinciden</p>';
            header("Location: ../alta.php");
            exit();
        }

        if ($_FILES["img"]["error"] == UPLOAD_ERR_OK) {
            if ($_FILES["img"]["size"] < 1000000) {
                $ruta_subida = "../bbdd/";
                $res = move_uploaded_file($_FILES["img"]["tmp_name"], $ruta_subida . $_FILES["img"]["name"]);

                if ($res) {
                    unset($_SESSION["errorImg"]);
                } else {
                    $_SESSION["errorImg"] = '<p class="error">Error al guardar fichero</p>';
                }
            } else {
                $_SESSION["errorImg"] = '<p class="error">Tamaño imagen demasiado grande</p>';
                exit();
            }
        }

        unset($_SESSION['name']);
        unset($_SESSION['lastname']);
        unset($_SESSION['email']);

        $user = new User();
        $user->name = $name;
        $user->lastname = $lastname;
        $user->email = $email;
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $user->password = $passwordHash;
        if ($_FILES["img"]["error"] == UPLOAD_ERR_OK) {
            $user->img = $img;
        }

        $lista_usuarios = [];
        $file = '../bbdd/data.json';
    
        $jsonData = file_get_contents("./{$file}", FILE_USE_INCLUDE_PATH);
        $lista_usuarios = json_decode($jsonData);

        //cookie
        $userCookie = json_encode(array($email, date("d, m, Y"), date("H:i")));
        setcookie('last_user', $userCookie, time() + 3600, '/');


        array_push($lista_usuarios, $user);
        $json_usuarios = json_encode($lista_usuarios, JSON_PRETTY_PRINT);
        file_put_contents("../bbdd/data.json", $json_usuarios);
        $_SESSION['userSing'] = '<p class="sing">Usuario añadido</p>';
    }
header("Location: ../alta.php");