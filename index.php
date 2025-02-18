<?php
require_once 'database.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
$url = $_SERVER['REQUEST_URI'];

$rota = str_replace('/RevistaDigital_API', '' , $url );

switch(true){
    
    case $rota == '/users' or preg_match("#/users/(\d+)#" , $rota , $array):
        require 'routes/users.php';
        break;
    case $rota == '/categorias' or preg_match("#/categorias/(\d+)#", $rota , $array):
        require 'routes/categorias.php';
        break;
    case $rota == '/posts' or preg_match("#/posts/(\d+)#", $rota, $array):
        require 'routes/posts.php';
        break;
}