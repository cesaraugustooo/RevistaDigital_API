<?php
require_once 'database.php';
require_once 'json_request/json_sucess_error.php';

class Postagens
{
    public static function POST($json){
        $db = Database::connect();
        $sql = $db->prepare("INSERT INTO posts VALUES(null,:titulo,:foto,:descricao,:data, :usuario, :categoria)");
        $sql->bindValue(':titulo',$json['titulo_post']);
        $sql->bindValue(':foto',$json['foto_post']);
        $sql->bindValue(':descricao',$json['descricao_post']);
        $sql->bindValue(':data',$json['data_criacao_post']);
        $sql->bindValue(':usuario',$json['usuarios_id_usuario']);
        $sql->bindValue(':categoria',$json['categorias_id_categoria']);

        $sql->execute();
        
        successJson($sql);
    }
    public static function get(){
        $db = Database::connect();
        $sql = $db->prepare("SELECT * FROM posts");
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function update($json,$id){
        $db = Database::connect();
        $sql = $db->prepare("UPDATE posts SET titulo_post = :titulo, foto_post = :foto, descricao_post = :descricao, data_criacao_post = :data, categorias_id_categoria = :categoria WHERE id_post = :id");
        $sql->bindValue(':titulo',$json['titulo_post']);
        $sql->bindValue(':foto',$json['foto_post']);
        $sql->bindValue(':descricao',$json['descricao_post']);
        $sql->bindValue(':data',$json['data_criacao_post']);
        $sql->bindValue(':categoria',$json['categorias_id_categoria']);
        $sql->bindValue(':id', $id , PDO::PARAM_INT);

        $sql->execute();
        successJson($sql);
    }
    public static function delete($id){
        $db = Database::connect();
        $sql = $db->prepare("DELETE FROM posts WHERE id_post = :id");
        $sql->bindValue(':id', $id , PDO::PARAM_INT);

        $sql->execute();

        successJson($sql);
    }
    public static function getID($id){
        $db = Database::connect();
        $sql = $db->prepare("SELECT * FROM posts WHERE id_post = :id");
        $sql->bindValue(':id', $id, PDO::PARAM_INT);

        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);
    }
    public static function getPostCategoria($id){
        $db = Database::connect();
        $sql = $db->prepare("SELECT * FROM posts WHERE categorias_id_categoria = :id");
        $sql->bindValue(':id', $id , PDO::PARAM_INT);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}


