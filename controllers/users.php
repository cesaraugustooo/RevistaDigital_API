<?php
require_once 'models/users.php';

class UserController
{
    public static function postUser(){
        $json = json_decode(file_get_contents('php://input'),true);
        UserModel::postUsers($json);
    }
    public static function getUsers(){
        header('Content-Type: application//json');
        http_response_code(200);
        echo json_encode(UserModel::getUsers());
    }
    public static function updateUser($id){
        $json = json_decode(file_get_contents('php://input'),true);
        
        $user = UserModel::getUserById($id);

        if($user == false){
            http_response_code(404);
            header('Content-Type: application//json');
            echo json_encode($mensagem = ["detail" => "Usuario não encontrado"]);
        }else{
            UserModel::updateUser($json,$id);
        }
        
    }
}