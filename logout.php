<?php
    include_once("config/db.php");
    unset($_SESSION["id"]);
    unset($_SESSION["username"]);
    unset($_SESSION["isLoggedIn"]);
    header("Location: index.php");
?>