<?php
require_once 'models/posts.php';

class Controller_Posts
{
    public static function POST(){
        $json = json_decode(file_get_contents('php://input'),true);
        Postagens::POST($json);
    }
}