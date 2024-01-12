<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta</title>
    <link rel="stylesheet" href="./css/menu.css">
    <link rel="stylesheet" href="./css/alta.css">
    <link rel="stylesheet" href="./css/footer.css">
</head>
<body>
    <?php include "components/menu.php"?>

<main>
    <form action="controlador/procesar_alta.php" method="post" enctype="multipart/form-data">
        <header>Alta de Usuario</header>
        <label for="name">Nombre: </label>
        <input type="text" name="name" id="name">
        <label for="lastname">Apellido: </label>
        <input type="text" name="lastname" id="lastname">
        <label for="email">*Email: </label>
        <input type="text" name="email" id="email">
        <label for="password">*Contraseña: </label>
        <input type="password" name="password" id="password">
        <label for="passwordRepeat">*Repite Contraseña: </label>
        <input type="password" name="passwordRepeat" id="passwordRepeat">
        <input type="file" name="img" id="img">
        <?php
            if (isset($_SESSION['errorAlta'])) {
                echo $_SESSION['errorAlta'];
                unset($_SESSION['errorAlta']);
            }
            if (isset($_SESSION['errorImg'])) {
                echo $_SESSION['errorImg'];
                unset($_SESSION['errorImg']);
            }
            if (isset($_SESSION['userSing'])) {
                echo $_SESSION['userSing'];
                unset($_SESSION['userSing']);
            }
        ?>
        <button>Alta Usuario</button>

        <p>* Casillas obligatorias</p>
    </form>
</main>


    <?php include "components/footer.php"?>
</body>
</html>