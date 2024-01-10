<?php
session_start();


if (isset($_SESSION["errorLogin"])) {
    $errorLogin = $_SESSION["errorLogin"];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/alta.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>
<?php include "menu.php"?>

    <main>
        <form action="controlador/procesar_login.php" method="post">
            <header>Login</header>
            <div class="content">
            <div class="left">
                <p>Email@:</p>
                <p>Contraseña</p>
            </div>
            <div class="right">
                <input type="text" name="email">
                <input type="password" name="pass1">
            </div>

            
            
            </div>
            <?php
                if (isset($errorLogin)) {
                    print "<p class='error'>$errorLogin</p>";
                }
            ?>
            <button>Log in</button>
            <p>* Campos obligatorios</p>
        </form>
    </main>



<?php include "footer.php"?>

</body>
</html>
