<?php
require_once 'c:/xampp/htdocs/RevistaDigital_API/json_request/json_sucess_error.php';
require_once 'c:/xampp/htdocs/RevistaDigital_API/database.php';
require_once '../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Login
{
    

    public static function login(){
        header('Content-Type: application/json');
    
        $json = json_decode(file_get_contents('PHP://input'),true);
        $db = Database::connect();
        $sql = $db->prepare('SELECT id_usuario,user_usuario,nivel FROM usuarios WHERE user_usuario = :user AND senha_usuario = :senha');
        $sql->bindValue(':user',$json['user_usuario']);
        $sql->bindValue(':senha',$json['senha_usuario']);
        $sql->execute();

        $data = $sql->fetch(PDO::FETCH_ASSOC);

      

        if($data){
            $payload = [
                'id_user' => $data['id_usuario'],
                'nivel' => $data['nivel'],
                'exp' => time() + 7200 

            ];
            $key = '12345';
    
            $jwt = JWT::encode($payload,$key,'HS256');
            $decoded = JWT::decode($jwt,new Key($key,'HS256'));
            echo json_encode([
                "code" => 200,
                "jwt"=>[
                    "token" => $jwt,
                    "payload" =>[
                        'id_user' => $decoded->id_user,
                        'nivel' => $decoded->nivel
                    ]
                ]
            ]);
        }else{
            http_response_code(401);
            echo json_encode([
                "code" => 401
            ]);
        }
       
    }
}