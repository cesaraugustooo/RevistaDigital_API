<?php
require_once 'models/posts.php';

class Controller_Posts
{
    public static function POST(){
        $json = json_decode(file_get_contents('php://input'),true);
        Postagens::POST($json);
    }
    public static function get(){
        header('Content-Type: application//json');
        http_response_code(200);
        echo json_encode(Postagens::get());
    }
    public static function delete($id){
        Postagens::delete($id);
    }
    public static function update($id){
        $json = json_decode(file_get_contents('php://input'),true);
        Postagens::update($json,$id);
    }
}