<?php
require_once 'models/categorias.php';

class CategoriasController
{
    public static function post(){
        $json = json_decode(file_get_contents('php://input'),true);
        CategoriaModels::post($json);
    }
    public static function get(){
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode(CategoriaModels::get());
    }
    public static function update($id){
        $json = json_decode(file_get_contents('php://input'),true);
        
        $user = CategoriaModels::getID($id);

        if($user == false){
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode($mensagem = ["detail" => "Usuario não encontrado"]);
        }else{
            CategoriaModels::update($json,$id);
        }
        
    }
    public static function getID($id){
        header('Content-Type: application//json');
        http_response_code(200);
        echo json_encode(CategoriaModels::getID($id));
    }
    public static function delete($id){
        CategoriaModels::delete($id);
    }
}