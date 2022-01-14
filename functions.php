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
    $query    = "SELECT * FROM `users` WHERE username='$username';";
    $result = mysqli_query($conn, $query) or die(mysql_error());
    $rows = mysqli_num_rows($result);
    if($rows >= 1){
        return 0;
    }
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

function like($title,$description,$publishedAt,$image,$conn){
    $myId = $_SESSION['id'];
    $title = mysqli_real_escape_string($conn, stripslashes($title));
    $query    = "SELECT * FROM `likes` WHERE `user_id` = '$myId' and title = '$title';";
    $result = mysqli_query($conn, $query) or die(mysql_error());
    $rows = mysqli_num_rows($result);
    if ($rows >= 1){
        return 0;
    }
    $description = mysqli_real_escape_string($conn, stripslashes($description));
    $publishedAt = mysqli_real_escape_string($conn, stripslashes($publishedAt));
    $image = mysqli_real_escape_string($conn, stripslashes($image));
    $myId = $_SESSION['id'];
    $query    = "INSERT into likes (user_id,title,description,published_at,image) VALUES ('$myId','$title','$description','$publishedAt','$image');";
    $result   = mysqli_query($conn, $query);
    if ($result) {
        return 1;
    }
    return 0;
}

function getMyLikes($conn){
    $myId = $_SESSION['id'];
    $query    = "SELECT * FROM `likes` WHERE `user_id` = '$myId';";
    $result = mysqli_query($conn, $query) or die(mysql_error());
    $rows = mysqli_num_rows($result);
    $news = [];
    if ($rows >= 1) {
        while($row = mysqli_fetch_assoc($result)){
            $title = $row['title'];
            $description = $row['description'];
            $publishedAt = $row['published_at'];
            $image = $row['image'];
            $id = $row['id'];
            $newNews = new News($title,$description,$publishedAt,$image);
            $newNews->set_id($id);
            array_push($news,$newNews);
        }
    }
    return $news;
}

function deleteLike($conn,$likeId){
    $query    = "DELETE FROM `likes` WHERE `id` = '$likeId';";
    $result = mysqli_query($conn, $query) or die(mysql_error());
    if ($result) {
        return 1;
    }
    return 0;
}

?>