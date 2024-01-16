<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="./css/menu.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/footer.css">
    <script type="module" src="./js/index.js"></script>
</head>
<body>
    <?php include "components/menu.php"?>

    <main>
        <?php
            if(isset($_SESSION['userLogin']) && $_SESSION['userLogin']->email == 'admin@gmail.com') {
                $user_list = [];
                        $file = 'data.json';
                        $jsonData = file_get_contents("bbdd/{$file}");
                        $user_list = json_decode($jsonData);
                        echo "<h2>Usuarios dados de alta: " . count($user_list) . "</h2>";
                        
                        if (isset($_COOKIE['last_user'])) {
                            $cookieData = json_decode($_COOKIE['last_user']);
            
                            echo "<p>Último usuario de alta: " . $cookieData[0] . " el día " . $cookieData[1] . " a las " . $cookieData[2] . "</p>";
                        }

                        echo "<h3>Información de usuarios</h3>";
                        echo "<div class='userContainer'>";
                        foreach ($user_list as $user) {
                            echo "<div class='tarjetUser'>
                                    <img src='./bbdd/{$user->img}'>";
    
                            if ($user->name != null) {
                                echo "<p>{$user->name}</p>";
                            }
    
                            if ($user->lastname != null) {
                                echo "<p>{$user->lastname}</p>";
                            }
                            echo "<p>" . $user->email . "</p>";
                            ?>
                            <form action="borrar_usuario.php" method="get">
                                <input type="hidden" name="email" value="<?php echo $user->email; ?>">
                                <button type="submit" class="delete-user">Eliminar Usuario</button>
                            </form>

                            <?php
                            echo "</div>";
                        }
                        echo "</div>";
            } else {
            ?>
                <div class="main">
                <div class="container">
                    <!-- <input type="checkbox" id="category" name="category"/>
                    <label for="category">men's</label> -->
                </div>

<div class="container-category"></div>
                </div>


            <?php
            }
        ?>
    </main>

    <?php include "components/footer.php"?>
</body>
</html>