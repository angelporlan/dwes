

<header>
    <h1>ALTA Y LOGIN DE USUARIOS</h1>
</header>
<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="alta.php">Alta</a></li>
        <div class="right-zone">
        <?php
        if (isset($_SESSION['userObject'])) {

        $email_usuario = $_SESSION["userObject"]->email;
        echo " <li class='right red'><a href='perfil.php'>Hola, {$email_usuario}</a></li>";
        }

        
        ?>

        
        <?php 
           echo " <li class='right red'><a href='logout.php'>Log out</a></li>";
        ?>
        </div>

    </ul>

    
</nav>