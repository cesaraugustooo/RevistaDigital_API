<?php
require_once 'database.php';
require_once 'json_request/json_sucess_error.php';

class CategoriaModels
{
    public static function post($json){
        $db = Database::connect();
        $sql = $db->prepare("INSERT INTO categorias VALUES(null,:nome,:descricao)");
        $sql->bindValue(':nome', $json['nome_categoria']);
        $sql->bindValue(':descricao', $json['descricao_categoria']);

        $sql->execute();

        successJson($sql);

    }
    public static function get(){
        $db = Database::connect();
        $sql = $db->prepare("SELECT * FROM categorias");
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);

    }
    public static function update($json,$id){
        $db = Database::connect();
        $sql = $db->prepare("UPDATE categorias SET nome_categoria = :nome, descricao_categoria = :descricao WHERE id_categoria = :id");
        $sql->bindValue(':nome', $json['nome_categoria']);
        $sql->bindValue(':descricao', $json['descricao_categoria']);
        $sql->bindValue(':id', $id , PDO::PARAM_INT);

        $sql->execute();

        successJson($sql);
    }
    public static function getID($id) {
        $db = Database::connect();
        $sql = $db->prepare("SELECT * FROM categorias WHERE id_categoria = :id");
        $sql->bindValue(':id', $id, PDO::PARAM_INT);

        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);
    }
    public static function delete($id){
        $db = Database::connect();
        $sql = $db->prepare("DELETE FROM categorias WHERE id_categoria = :id");
        $sql->bindValue(':id', $id , PDO::PARAM_INT);

        $sql->execute();

        successJson($sql);
    }
    
}


