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
        if($rota == '/login'){
            Login::login();
        }
        break;
}
