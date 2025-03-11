<?php
require_once 'c://xampp/htdocs/RevistaDigital_API/controllers/comentarios.php';

$method = $_SERVER['REQUEST_METHOD'];
$rota = str_replace('/RevistaDigital_API', '' , $_SERVER['REQUEST_URI'] );

switch($method){
    case 'GET':
        if(preg_match("#/comentarios/idpost/(\d+)#",$rota, $array)){
            ComentariosController::getComentarioPost($array[1]);
            break;
        }elseif(preg_match("#/comentarios/(\d+)#", $rota ,$array)){
            ComentariosController::getComentarioId($array[1]);
            break;
        }
    case 'POST':
        ComentariosController::postComentario();
        break;
    case 'DELETE':
        preg_match("#/comentarios/(\d+)#",$rota, $array);
        ComentariosController::deleteComentario($array[1]);
        break;
    case 'PUT':
        preg_match("#/comentarios/(\d+)#",$rota, $array);
        ComentariosController::updateComentario($array[1]);
        break;
}