<?php
session_start();

if (isset($_SESSION["errorEmail"])) {
    $errorEmail = $_SESSION["errorEmail"];
}

if (isset($_SESSION["errorPassword"])) {
    $errorPassword = $_SESSION["errorPassword"];
}

if (isset($_SESSION["errorFichero"])) {
    $errorFichero = $_SESSION["errorFichero"];
}

if (isset($_SESSION["dataOK"])) {
    $dataOK = $_SESSION["dataOK"];
}

// print "<pre>";
// print "Matriz \$_SESSION" . "<br>";
// print_r($_SESSION);
// print "</pre>\n";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/alta.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>
<?php include "menu.php"?>

    <main>
        <form action="controlador/procesar_alta.php" method="post" enctype="multipart/form-data">
            <header>Alta</header>
            <div class="content">
            <div class="left">
                <p>Nombre:</p>
                <p>Apellidos:</p>
                <p>*Email@:</p>
                <p>*Contraseña:</p>
                <p>*Repita contraseña:</p>
                <p>Foto de Perfil (max 1MB):</p>
            </div>
            <div class="right">
                <input type="text" name="firstname" value="<?php echo !empty($_SESSION['usuario']) ? $_SESSION["usuario"]["name"] : ''; ?>">
                <input type="text" name="lastname"  value="<?php echo !empty($_SESSION['usuario']) ? $_SESSION["usuario"]["lastname"] : ''; ?>">
                <input type="text" name="email" value="<?php echo !empty($_SESSION['usuario']) ? $_SESSION["usuario"]["email"] : ''; ?>">
                <input type="password" name="pass1" value="<?php echo !empty($_SESSION['usuario']) ? $_SESSION["usuario"]["pass1"] : ''; ?>">
                <input type="password" name="pass2" value="<?php echo !empty($_SESSION['usuario']) ? $_SESSION["usuario"]["pass2"] : ''; ?>">
                <input type="file" name="photo">
            </div>
            <?php
        if (isset($errorEmail)) {
            print "<p class='error'>$errorEmail</p>";
        }
        if (isset($errorPassword)) {
            print "<p class='error'>$errorPassword</p>";
        }
        if (isset($errorFichero)) {
            print "<p class='error'>$errorFichero</p>";
        }

        if (isset($dataOK) && $dataOK == true) {
            print "<p class='dataok'>Alta de usuario correcta</p>";
            unset($_SESSION["dataOK"]); 
        }

        ?>
            </div>
            <button>Alta de nuevo usuario</button>
            <p>* Campos obligatorios</p>
        </form>
    </main>



<?php include "footer.php"?>

</body>
</html>
