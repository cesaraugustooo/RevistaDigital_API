<?php
require_once 'database.php';

$url = $_SERVER['REQUEST_URI'];

$rota = str_replace('/RevistaDigital_API', '' , $url );

switch(true){
    
    case $rota == '/users' or preg_match("#/users/(\d+)#" , $rota , $array):
        require 'routes/users.php';
        break;
}