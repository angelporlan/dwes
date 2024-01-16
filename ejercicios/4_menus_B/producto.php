<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario</title>
    <link rel="stylesheet" href="./css/menu.css">
    <link rel="stylesheet" href="./css/producto.css">
    <link rel="stylesheet" href="./css/footer.css">
    <script type="module" src="./js/producto.js"></script>
</head>
<body>
    <?php include "components/menu.php"?>

    <main>
        <div class="product"></div>

        <div class="comments">
            <strong>0 Comentarios</strong>
            
            <div class="comment-input">
            <?php
            if (isset($_SESSION['userLogin'])) {
                echo "<img src='./bbdd/{$_SESSION['userLogin']->img}'/>";
                echo "<input type='text' name='comment' placeholder='¿Qué tienes en mente?'>";
            } else {
                echo "<strong>Inicia sesión para poder comentar</strong>";
            }
            ?>
            </div>
        </div>
        
    </main>

    <?php include "components/footer.php"?>
</body>
</html>