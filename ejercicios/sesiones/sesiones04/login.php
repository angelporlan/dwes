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
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <a href="alta.php"><button>Registrarse</button></a>
</header>
    <h2>Iniciar Sesión</h2>
    
    

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <label for="email">Email:</label>
        <input type="email" name="email" value=<?php if (isset( $_SESSION['email-login'])) { print $_SESSION['email-login']; } ?>><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" name="password"><br><br>

        <input type="submit" value="Iniciar Sesión">
    </form>

    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $email = recoge('email');
            $password = recoge('password');
            $_SESSION['email-login'] = $email;
            $ok = true;
            $usuarioEncontrado = false;
            
            if (!comprobarDatos($email)) {
                $emailError = '<p class="error">La casilla email esta vacia</p>';
                $ok = false;
            }
            if (!comprobarDatos($password)) {
                $passwordError = '<p class="error">La casilla contraseña esta vacia</p>';
                $ok = false;
            }
            

            if ($ok) {
                unset($_SESSION['email-login']);

                $usuarios = [];
        
                if (file_exists('bbdd/datos.json')) {
                    $usuarios_json = file_get_contents('bbdd/datos.json');
                    $usuarios = json_decode($usuarios_json);
                }

                if (!$usuarios == []) {
                    foreach ($usuarios as $usuario) {
                        if ($email == $usuario->email && $password == $usuario->password) {
                            $usuarioEncontrado = true;
                            print ("
                            <div class='datos'>    
                            <img src='bbdd/$usuario->imagen' style='width: 300px; height: 300px;' />
                                <p>Nombre: $usuario->nombre</p>
                                <p>Apellidos: $usuario->apellidos</p>
                                <p>Telefono: $usuario->telefono</p>
                                <p>Email: $usuario->email</p>
                                <p>Contraseña: $usuario->password</p>
                            </div>
                                ");
                        }
                        
                    }
                } 

                if (!$usuarioEncontrado) {
                    print "<p class='error'>Email o contraseña incorrectos.</p>";
                }
                return;
            }
            
            if (isset($emailError)) {
                print $emailError;
            }
            if (isset($passwordError)) {
                print $passwordError;
            }

        }
    ?>

</body>
</html>
