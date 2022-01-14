<?php
include_once("news.php");
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
?>