<?php
require_once 'C:\xampp\htdocs\RevistaDigital_API\database.php';
require_once 'C:\xampp\htdocs\RevistaDigital_API\json_request\json_sucess_error.php';

class Postagens
{
    public static function POST($json){
       
        $db = Database::connect();
        $sql = $db->prepare("INSERT INTO posts VALUES(null,:titulo,:foto,:descricao,:data, :usuario, :categoria, :status, :sub , :subf)"); 
        $sql->bindValue(':titulo',$json['titulo_post']);
        $sql->bindValue(':foto',$json['foto_post']);
        $sql->bindValue(':descricao',$json['descricao_post']);
        $sql->bindValue(':data',date('Y-m-d H:i:s'));
        $sql->bindValue(':usuario',$json['usuarios_id_usuario']);
        $sql->bindValue(':categoria',$json['categorias_id_categoria']);
        $sql->bindValue(':status',$json['status_post']);
        $sql->bindValue(':sub',$json['sub_titulo_post']);
        $sql->bindValue(':subf',$json['sub_foto_post']);




        $sql->execute();
        
        successJson($sql);
    }
    public static function get(){
        $db = Database::connect();
        $sql = $db->prepare("SELECT * FROM posts WHERE status_post = 1");
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function update($json,$id){
        $db = Database::connect();
        $sql = $db->prepare("UPDATE posts SET titulo_post = :titulo, foto_post = :foto, descricao_post = :descricao, data_criacao_post = :data, categorias_id_categoria = :categoria, status_post = :status WHERE id_post = :id");
        $sql->bindValue(':titulo',$json['titulo_post']);
        $sql->bindValue(':foto',$json['foto_post']);
        $sql->bindValue(':descricao',$json['descricao_post']);
        $sql->bindValue(':data',$json['data_criacao_post']);
        $sql->bindValue(':categoria',$json['categorias_id_categoria']);
        $sql->bindValue(':status',$json['status_post']);

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
        $sql = $db->prepare("SELECT * FROM posts WHERE categorias_id_categoria = :id AND status_post = 1");
        $sql->bindValue(':id', $id , PDO::PARAM_INT);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function getPostNull(){
        $db = Database::connect();
        $sql = $db->prepare("SELECT * FROM posts WHERE status_post = 0");
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function updateStatus($json,$id){
        $db = Database::connect();
        $sql = $db->prepare("UPDATE posts SET  status_post = :status  WHERE id_post = :id");
        $sql->bindValue(':status',$json['status_post']);
        $sql->bindValue(':id', $id , PDO::PARAM_INT);

        $sql->execute();
        successJson($sql);
    }
    
}


