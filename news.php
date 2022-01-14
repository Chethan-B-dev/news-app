<?php

class News{

    private $title;
    private $description;
    private $publishedAt;
    private $image;
    private $id = -1;

    function __construct($title,$description,$publishedAt,$image) {
        $this->title = $title;
        $this->description = $description;
        $this->publishedAt = $publishedAt;
        $this->image = $image;
    }

    function get_title() {
        return $this->title;
    }

    function get_description() {
        return $this->description;
    }

    function get_published_at() {
        return $this->publishedAt;
    }

    function get_image() {
        return $this->image;
    }

    function get_id() {
        return $this->id;
    }

    function set_title($title) {
        $this->title = $title;
    }

    function set_id($id) {
        $this->id = $id;
    }

    function set_description($description) {
        $this->description = $description;
    }

    function set_publishedAt($publishedAt) {
        $this->publishedAt = $publishedAt;
    }

    function set_image($image) {
        $this->image = $image;
    }

}


?>