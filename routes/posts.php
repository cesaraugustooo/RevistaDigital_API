<?php
require_once 'C:\xampp\htdocs\RevistaDigital_API\controllers\posts.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");


$url = $_SERVER['REQUEST_URI'];

$rota = str_replace('/RevistaDigital_API', '' , $url );

$method = $_SERVER['REQUEST_METHOD'];

switch($method){
    case 'POST':
        if($rota == '/posts/images'){
            require 'C:\xampp\htdocs\RevistaDigital_API\models\images.php';
        }else{
            Controller_Posts::POST();
            break;
        }

    case 'GET':
        if(preg_match("#/posts/categoria/(\d+)#", $rota , $array)){
            Controller_Posts::getPostCategoria($array[1]);
            break;
        }elseif($rota == '/posts/null'){
            Controller_Posts::getPostNull();
            break;
        }elseif($rota == '/posts'){
            Controller_Posts::getPosts();
            break;
        }

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
    case 'PATCH':
        if(preg_match("#/posts/(\d+)#", $rota , $array)){
            Controller_Posts::updateStatus($array[1]);
            break;
        }
}
