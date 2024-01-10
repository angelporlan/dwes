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
        <form action="">
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
                <input type="text" name="firtname" id="">
                <input type="text" name="lastname" id="">
                <input type="text" name="email" id="">
                <input type="password" name="pass1" id="">
                <input type="password" name="pass2" id="">
                <input type="submit" value="">
            </div>
            </div>
            <button>Alta de nuevo usuario</button>
            <p>* Campos obligatorios</p>
        </form>
    </main>



<?php include "footer.php"?>

</body>
</html>
