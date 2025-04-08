<?php
require_once 'c://xampp/htdocs/RevistaDigital_API/database.php';
require_once 'c://xampp/htdocs/RevistaDigital_API/json_request/json_sucess_error.php';
class Comentarios
{
    public static function post($json){
        $dirImg = '';
        $db = Database::connect();
        $sql = $db->prepare("INSERT INTO comentarios VALUES(null, :conteudo_comentario, :data_comentario, :categorias_id_categoria, :usuarios_id_usuario, :posts_id_post)");
        $sql->bindValue(':conteudo_comentario', $json['conteudo_comentario']);
        $sql->bindValue(':data_comentario', date('Y-m-d H:i:s'));
        $sql->bindValue(':categorias_id_categoria', $json['categorias_id_categoria']);
        $sql->bindValue(':usuarios_id_usuario', $json['usuarios_id_usuario']);
        $sql->bindValue(':posts_id_post', $json['posts_id_post']);
        
        $sql->execute();

        successJson($sql);
    }

    public static function getIdPost($id){
        $db = Database::connect();
        $sql = $db->prepare("SELECT * FROM comentarios WHERE posts_id_post = :id_post");
        $sql->bindValue(':id_post', $id , PDO::PARAM_INT);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);        
    }

    public static function getId($id){
        $db = Database::connect();
        $sql = $db->prepare("SELECT * FROM comentarios WHERE id_comentario = :id");
        $sql->bindValue(':id', $id , PDO::PARAM_INT);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);        
    }

    public static function delete($id){
        $db = Database::connect();
        $sql = $db->prepare("DELETE FROM comentarios WHERE id_comentario = :id");
        $sql->bindValue(':id', $id, PDO::PARAM_INT);
        $sql->execute();

        successJson($sql);

    }

    public static function update($json, $id){
        $db = Database::connect();
        $sql = $db->prepare("UPDATE comentarios SET conteudo_comentario = :conteudo, data_comentario = :data WHERE id_comentario = :id");
        $sql->bindValue(':conteudo', $json['conteudo_comentario']);
        $sql->bindValue(':data', $json['data_comentario']);
        $sql->bindValue(':id', $id, PDO::PARAM_INT);
        $sql->execute();

        successJson($sql);

    }
}
