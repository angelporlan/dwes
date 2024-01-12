<header>Alta y Login de usuarios</header>

<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="alta.php">Alta</a></li>
        <?php
            session_start();
            if (isset($_SESSION["userLogin"])) {
                echo "<li><a href='user.php'>Hola, " . $_SESSION["userLogin"]->email ."</a></li>";
                echo "<li><a href='logout.php'>Log out</a></li>";
            } else {
                echo "<li><a href='login.php'>Log in</a></li>";
            }
        ?>
        
    </ul>

</nav>