<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "news_app";


    $conn = mysqli_connect($servername, $username, $password,$database);
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

?>