<?php
require_once 'C:\xampp\htdocs\RevistaDigital_API\controllers\users.php';
require_once 'C:\xampp\htdocs\RevistaDigital_API\models\login.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

$url = $_SERVER['REQUEST_URI'];

$rota = str_replace('/RevistaDigital_API', '' , $url );


$method = $_SERVER['REQUEST_METHOD'];

switch($method){

    case 'POST':
        UserController::postUser();
        if($rota == '/login'){
            Login::login(json_decode(file_get_contents('PHP://input'),true));
        }
        break;
    case 'GET':
        if(preg_match("#/users/(\d+)#", $rota, $array)){
            UserController::getUserById($array[1]);
            break;
        }else{
        UserController::getUsers();
        break;
        }
    case 'PUT':
        if(preg_match("#/users/(\d+)#" , $rota , $array)){
            UserController::updateUser($array[1]);
        }
}
