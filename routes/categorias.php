<?php

require_once 'index.php';
require_once 'controllers/categorias.php';
require_once 'models/categorias.php';

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