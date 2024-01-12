<?php
    session_start();
    require_once('../modelo/modelo.php');
    require_once('../includes/funciones.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = recoge("firstname");
        $lastname = recoge("lastname");
        $email = recoge("email");
        $pass1 = recoge("pass1");
        $pass2 = recoge("pass2");

        $_SESSION["user"]["name"] = $name;
        $_SESSION["user"]["lastname"] = $lastname;
        $_SESSION["user"]["email"] = $email;
        $_SESSION["user"]["pass1"] = $pass1;
        $_SESSION["user"]["pass2"] = $pass2;

        if ($_FILES["photo"]["error"] == UPLOAD_ERR_OK) {
            $photo = $_FILES["photo"]["name"];
            $tamBytes = $_FILES["photo"]["size"];
        } else {
            print("no hay fichero");
        }
        
        $_SESSION["dataOK"] = true;
        //email
        if (!str_contains($email, '@') || !str_contains($email, '.')) {
            $_SESSION["errorEmail"] = "Email inválido. Debe contener @ y .";
            $_SESSION["dataOK"] = false;
        } else if (existeUsuario($email)) {
            $_SESSION["errorEmail"] = "El email ya existe. Use otro distinto";
            $_SESSION["dataOK"] = false;
        } else {
            unset($_SESSION["errorEmail"]);
        }
        //password
        if (empty($pass1) || empty($pass2)) {
            $_SESSION["errorPassword"] = "Debe ingresar ambas contraseñas";
            $_SESSION["dataOK"] = false;
        } elseif ($pass1 !== $pass2) {    
            $_SESSION["errorPassword"] = "El password no coincide";
            $_SESSION["dataOK"] = false;
        } else {
            unset($_SESSION["errorPassword"]);
        }

        //Imagen
        if ($_FILES["photo"]["error"] == UPLOAD_ERR_OK) {
            if ($_FILES["photo"]["size"] < 1000000) {
                $ruta_subida = "../bbdd/";
                $res = move_uploaded_file($_FILES["photo"]["tmp_name"], $ruta_subida . $_FILES["photo"]["name"]);

                if ($res) {
                    unset($_SESSION["errorFichero"]);
                } else {
                    $_SESSION["errorFichero"] = "Error al guardar fichero";
                }
            } else {
                $_SESSION["errorFichero"] = "Tamaño imagen demasiado grande";
                $_SESSION["dataOK"] = false;
            }
        }

        if ($_SESSION["dataOK"] == true) {

            print("<h2>DATOS OK</h2>");
    
            //Recupero la lista de usuarios
            $lista_usuarios = [];
            $file = '../bbdd/data.json';    //la carpeta bbdd debe existir
    
            $jsonData = file_get_contents("./{$file}", FILE_USE_INCLUDE_PATH);
            $lista_usuarios = json_decode($jsonData);
    
    
            //Me creo el objeto usuario
            $usuario = new Usuario;
            $usuario->nombre = $name;
            $usuario->apellidos = $lastname;
            $usuario->email = $email;
            //Codifico la contraseña
            $passwordHash = password_hash($pass1, PASSWORD_DEFAULT);
            $usuario->password = $passwordHash;

            if ($_FILES["photo"]["error"] == UPLOAD_ERR_OK) {
                $usuario->imagen = $photo;
            }
    
            array_push($lista_usuarios, $usuario);
            $json_usuarios = json_encode($lista_usuarios, JSON_PRETTY_PRINT);
            // print "<pre>";
            // print_r($json_usuarios);
            // print "</pre>";
            file_put_contents("../bbdd/data.json", $json_usuarios);
    
            unset($_SESSION["usuario"]);
    
            //session_destroy();
        }
    }
    
    
    header("Location: ../alta.php");
    
    
?>