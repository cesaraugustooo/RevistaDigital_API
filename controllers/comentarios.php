<?php
require_once 'c://xampp/htdocs/RevistaDigital_API/models/comentarios.php';

class ComentariosController
{
    public static function postComentario(){
        $json = json_decode(file_get_contents('php://input'),true);
        Comentarios::post($json);
    }
     public static function getComentarioPost($id){
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode(Comentarios::getIdPost($id));
    }
    public static function getComentarioId($id){
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode(Comentarios::getId($id));
    }
    public static function updateComentario($id){
        $json = json_decode(file_get_contents('php://input'),true);
        
        $user = Comentarios::getId($id);

        if($user == false){
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode($mensagem = ["detail" => "Comentario não encontrado"]);
        }else{
            Comentarios::update($json,$id);
        }
        
    }
    public static function deleteComentario($id){
        Comentarios::delete($id);
    }
}