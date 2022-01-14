<?php
include_once("news.php");
require_once("./config/db.php");

function getNews() {
    $url = "https://newsapi.org/v2/top-headlines?apiKey=60f704b54e3f4ffa95492bf57aed6568&country=in&q=india";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    $json = json_decode($response, true);
    $articles = $json['articles'];


    $news = [];


    foreach ($articles as $key => $value) {
        $title = $value['title'];
        $description = $value['description'];
        $publishedAt = $value['publishedAt'];
        $image = $value['urlToImage'];
        

        $newNews = new News($title,$description,$publishedAt,$image);
        array_push($news,$newNews);
    }

    return $news;
}


function register($username,$password,$conn){
    
    $username = mysqli_real_escape_string($conn, stripslashes($username));
    $password = mysqli_real_escape_string($conn, stripslashes($password));
    $query    = "INSERT into `users` (username, password) VALUES ('$username', '" . md5($password) . "')";
    $result   = mysqli_query($conn, $query);
    if ($result) {
        return 1;
    }
    return 0;
}


function login($username,$password,$conn){
    $username = mysqli_real_escape_string($conn, stripslashes($username));
    $password = mysqli_real_escape_string($conn, stripslashes($password));
    // Check user is exist in the database
    $query    = "SELECT * FROM `users` WHERE username='$username' AND password='" . md5($password) . "'";
    $result = mysqli_query($conn, $query) or die(mysql_error());
    $row = mysqli_fetch_assoc($result);
    $rows = mysqli_num_rows($result);
    if ($rows == 1) {
        $_SESSION['id'] = $row['id'];
        return 1;
    }
    return 0;
}




?>