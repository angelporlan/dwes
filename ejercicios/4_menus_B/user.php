<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario</title>
    <link rel="stylesheet" href="./css/menu.css">
    <link rel="stylesheet" href="./css/user.css">
    <link rel="stylesheet" href="./css/footer.css">
    
</head>
<body>
    <?php include "components/menu.php"?>

    <main>
        <?php
        $name = $_SESSION['userLogin']->name;
        $lastname = $_SESSION['userLogin']->lastname;
        $email = $_SESSION['userLogin']->email;
        $imgRoot = "./bbdd/" . $_SESSION['userLogin']->img;
        ?>

        <div class="container-user">
                <?php
                echo "<img src='" . $imgRoot ."'>";
                if ($name == null && $lastname == null) {
                    echo "<p class='name'>" . $email . "</p>";
                } else {
                    echo "<p class='name'>" . $name . " " . $lastname . "</p>";
                }
                ?>

                <form action="borrar_usuario.php" method="get">
                    <input type="hidden" name="email" value="<?php echo $email; ?>">
                    <button type="submit" class="delete-user">Eliminar Usuario</button>
                </form>
        </div>

        <!-- <div class="container-info">
            <header>Configuración de usuario</header>
            <div class="imgs">
  <label for="perro"><input type="radio" id="perro" name="animalImg" value="perro"><img src="./bbdd/perro.jpg"></label>
  <label for="gato"><input type="radio" id="gato" name="animalImg" value="gato"><img src="./bbdd/gato.jpg"></label>
  <label for="capibara"><input type="radio" id="capibara" name="animalImg" value="capibara"><img src="./bbdd/capibara.jpg"></label>
  <label for="oso"><input type="radio" id="oso" name="animalImg" value="oso"><img src="./bbdd/oso.webp"></label>
</div> -->



<!-- <div class="radios">
  <input type="radio" id="perro" name="animalImg" value="perro">
  <input type="radio" id="gato" name="animalImg" value="gato">
  <input type="radio" id="capibara" name="animalImg" value="capibara">
  <input type="radio" id="oso" name="animalImg" value="oso">
</div> -->
        </div>
    </main>

    <?php include "components/footer.php"?>
</body>
</html>