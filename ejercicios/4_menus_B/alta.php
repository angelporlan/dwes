<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta</title>
</head>
<body>
    <?php include "components/menu.php"?>

    <main>
        <form action="controlador/procesar_alta.php" method="post" enctype="multipart/form-data">
            <header>Alta de Usuario</header>
            <label>Nombre: </label>
            <input type="text" name="name">
            <label>Apellido: </label>
            <input type="text" name="lastname">
            <label>*Email: </label>
            <input type="text" name="email">
            <label>*Contraseña: </label>
            <input type="password" name="password">
            <label>*Repite Contraseña: </label>
            <input type="password" name="passwordRepeat">
            <input type="file" name="photo">
            <?php
                if (isset($_SESSION['error'])) {
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                }
            ?>
            <button>Alta Usuario</button>

            <p>* Casillas obligatorias</p>
        </form>
    </main>

    <?php include "components/footer.php"?>
</body>
</html>