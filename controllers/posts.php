<?php
require_once 'models/posts.php';

class Controller_Posts
{
    public static function POST(){
        $json = json_decode(file_get_contents('php://input'),true);
        Postagens::POST($json);
    }
    public static function get(){
        header('Content-Type: application/json');
        http_response_code(200);
        $posts = Postagens::get();
        echo json_encode($posts);
    }
    public static function delete($id){
        Postagens::delete($id);
    }
    public static function update($id){
        $json = json_decode(file_get_contents('php://input'),true);
        
        $post = Postagens::getID($id);

        if($post == false){
            header('Content-Type: application/json');
            http_response_code(404);
            echo json_encode($mensagem = ["detail" => "Post não encontrado"]);
        }else{
            Postagens::update($json,$id);
        }
    }
}