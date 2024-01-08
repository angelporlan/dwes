<?php
    session_start();
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

    function comprobarDatos($var) {
        return isset($var);
    }

    function comprobarCorreoRepetido($correo) {
        if (file_exists('bbdd/datos.json')) {
            $usuarios_json = file_get_contents('bbdd/datos.json');
            $usuarios = json_decode($usuarios_json);
        } else {
            return true;
        }

        foreach ($usuarios as $usuario) {
            if ($usuario->email === $correo) {
                return false;
            }

        }
        return true;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Darse de alta</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <a href="login.php"><button>Iniciar sesión</button></a>
</header>

<h2>Registro de Usuarios</h2>



<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value=<?php if (isset($_SESSION['nombre'])){ echo $_SESSION['nombre']; } ?>><br><br>
        
        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" value=<?php if (isset($_SESSION['apellidos'])){ echo $_SESSION['apellidos']; } ?>><br><br>

        <label for="telefono">Teléfono:</label>
        <input type="tel" name="telefono" value=<?php if (isset($_SESSION['telefono'])){ echo $_SESSION['telefono']; } ?>><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value=<?php if (isset($_SESSION['email-alta'])){ echo $_SESSION['email-alta']; } ?>><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" name="password"><br><br>

        <label for="imagen">Imagen de Perfil:</label>
        <input type="file" name="imagen"><br><br>

        <input type="submit" value="Registrar">
    </form>
    
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = recoge('nombre');
        $apellidos = recoge('apellidos');
        $telefono = recoge('telefono');
        $email = recoge('email');
        $password = recoge('password');
        $imagen_temporal = 'default.png';

        
        $_SESSION['nombre'] = $nombre;
        $_SESSION['apellidos'] = $apellidos;
        $_SESSION['telefono'] = $telefono;
        $_SESSION['email-alta'] = $email;

        $ok = true;
        // print "<p>$nombre</p><p>$apellidos</p><p>$telefono</p><p>$email</p><p>$password</p>";
        if (!comprobarDatos($nombre)) {
            $nombreError = '<p class="error">La casilla nombre es un campo obligatorio</p>';
            $ok = false;
        }
        if (!comprobarDatos($apellidos)) {
            $apellidosError = '<p class="error">La casilla apellidos es un campo obligatorio</p>';
            $ok = false;
        }
        if (!is_numeric($telefono)) {
            $telefonoError = '<p class="error">La casilla telefono solo puede contener números</p>';
            $ok = false; 
        }
        if (!comprobarDatos($telefono)) {
                $telefonoError = '<p class="error">La casilla telefono es un campo obligatorio</p>';
                $ok = false;
        }  
        if (!comprobarDatos($email)) {
            $emailError = '<p class="error">La casilla email es un campo obligatorio</p>';
            $ok = false;
        }  

        // if (!comprobarCorreoRepetido($email))

        if (!comprobarDatos($password)) {
            $passwordError = '<p class="error">La casilla contraseña es un campo obligatorio</p>';
            $ok = false;
        }

        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $imagen_temporal = $_FILES['imagen']['tmp_name'];
            $nombre_imagen = $_FILES['imagen']['name'];
            $ruta_destino = 'bbdd/' . $nombre_imagen; // Ajusta la ruta de destino adecuadamente

            if (move_uploaded_file($imagen_temporal, $ruta_destino)) {
                // Imagen cargada con éxito
                $imagen_temporal = $nombre_imagen;
            } else {
                $imagen_temporal = 'default.png';
            }
        }
        
        if ($ok) {
            
            unset($_SESSION['nombre']);
            unset($_SESSION['apellidos']);
            unset($_SESSION['telefono']);
            unset($_SESSION['email-alta']);

            $nuevoUsuario = [
                'nombre' => $nombre,
                'apellidos' => $apellidos,
                'telefono' => $telefono,
                'email' => $email,
                'password' => $password,
                'imagen' => $imagen_temporal
            ];
            
            $usuarios = [];
        
            if (file_exists('bbdd/datos.json')) {
                $usuarios_json = file_get_contents('bbdd/datos.json');
                $usuarios = json_decode($usuarios_json, true);
            }
        
            $usuarios[] = $nuevoUsuario;

            $usuarios_json = json_encode($usuarios);
        

            file_put_contents('bbdd/datos.json', $usuarios_json);

            print "<p class='exito'>Usuario añadido exitosamente</p>";

        } else {
            

            if (isset($nombreError)) {
                print $nombreError;
            }
            if (isset($apellidosError)) {
                print $apellidosError;
            }
            if (isset($telefonoError)) {
                print $telefonoError;
            }
            if (isset($emailError)) {
                print $emailError;
            }
            if (isset($passwordError)) {
                print $passwordError;
            }
            
        }
    }
?>

</body>
</html>
