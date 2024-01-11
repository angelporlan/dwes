<?php
session_start();

unset($_SESSION['userObject']);

header("Location: index.php");
?>
