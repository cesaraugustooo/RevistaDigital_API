<?php
require_once 'controllers/posts.php';
require_once 'index.php';
$method = $_SERVER['REQUEST_METHOD'];

switch($method){
    case 'POST':
        Controller_Posts::POST();
        break;
    case 'GET':
        Controller_Posts::get();
        break;
    case 'DELETE':
        if(preg_match("#/posts/(\d+)#", $rota , $array)){
            Controller_Posts::delete($array[1]);
            break;
        }
    case 'PUT':
        if(preg_match("#/posts/(\d+)#", $rota , $array)){
            Controller_Posts::update($array[1]);
            break;
        }
}
