<?php
require_once 'controllers/users.php';
require_once 'index.php';

$method = $_SERVER['REQUEST_METHOD'];

switch($method){

    case 'POST':
        UserController::postUser();
        break;
    case 'GET':
        UserController::getUsers();
        break;
    case 'PUT':
        if(preg_match("#/users/(\d+)#" , $rota , $array)){
            UserController::updateUser($array[1]);
        }
}
