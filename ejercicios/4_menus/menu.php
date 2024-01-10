

<header>
    <h1>ALTA Y LOGIN DE USUARIOS</h1>
</header>
<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="alta.php">Alta</a></li>
        <?php
        if (isset($_SESSION['user'])) {

        $email_usuario = $_SESSION["user"]["email"];
        echo " <li class='right red'><a class='menu2'>Hola, {$email_usuario}</a></li>";
        }
        ?>

        <li class="right"><a href="login.php">Login</a></li>
        <?php 
        
        ?>
    </ul>

    
</nav>