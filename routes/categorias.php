<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
require_once 'C:\xampp\htdocs\RevistaDigital_API\controllers\categorias.php';

$rota = str_replace('/RevistaDigital_API', '' , $_SERVER['REQUEST_URI'] );

$method = $_SERVER['REQUEST_METHOD'];

switch($method){
    case 'POST':
        CategoriasController::post();
        break;
    case 'GET':
        if(preg_match("#/categorias/(\d+)#", $rota , $array)){
            CategoriasController::getID($array[1]);
        }else{
            CategoriasController::get();
        }
        break;
    case 'PUT':
        if(preg_match("#/categorias/(\d+)#" , $rota , $array)){
            CategoriasController::update($array[1]);
        }
        break;
    case 'DELETE':
        if(preg_match("#/categorias/(\d+)#" , $rota , $array)){
            CategoriasController::delete($array[1]);
        }
        break;
}