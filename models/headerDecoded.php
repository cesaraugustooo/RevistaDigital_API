<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require_once '../vendor/autoload.php';

class getToken
{
    public static function getToken($key){
        $headers = getallheaders();

        $authHeader = $headers['Authorization'];
        if($authHeader){
            $token = str_replace('Bearer ', '', $authHeader);
            $decoded = JWT::decode($token,new Key($key, 'HS256'));

            return $decoded;
        }else{
            header('Content-Type: application/json');
            echo json_encode(["message"=>"erro"]);
        }
    }
}