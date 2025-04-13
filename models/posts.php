<?php
require_once 'C:\xampp\htdocs\RevistaDigital_API\database.php';
require_once 'C:\xampp\htdocs\RevistaDigital_API\json_request\json_sucess_error.php';
require_once 'C:/xampp/htdocs/RevistaDigital_API/models/headerDecoded.php';
header('Content-Type: application/json');

class Postagens
{
    public static function POST($json){
        $key = '12345';

        $payload = getToken::getToken($key);
        if($payload->nivel == 'Admin' or $payload->nivel == 'Professor' or $payload->nivel == 'Usuario'){
            $db = Database::connect();
            $sql = $db->prepare("INSERT INTO posts VALUES(null,:titulo,:foto,:descricao,:data, :usuario, :categoria, :status, :sub , :subf,:subtext)"); 
            $sql->bindValue(':titulo',$json['titulo_post']);
            $sql->bindValue(':foto',$json['foto_post']);
            $sql->bindValue(':descricao',$json['descricao_post']);
            $sql->bindValue(':data',date('Y-m-d H:i:s'));
            $sql->bindValue(':usuario',$json['usuarios_id_usuario']);
            $sql->bindValue(':categoria',$json['categorias_id_categoria']);
            $sql->bindValue(':status',$json['status_post']);
            $sql->bindValue(':sub',$json['sub_titulo_post']);
            $sql->bindValue(':subf',$json['sub_foto_post']);
            $sql->bindValue(':subtext',$json['sub_descricao_post']);

            $sql->execute();

            successJson($sql);
        }else{
            http_response_code(401);
            echo json_encode(["message"=>"Usuario sem permissão"]);

        }
    }
    public static function get(){
        $db = Database::connect();
        $sql = $db->prepare("SELECT * FROM posts WHERE status_post = 1");
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function update($json,$id){
        $key = '12345';

        $payload = getToken::getToken($key);
        if($payload->nivel == 'Admin' or $payload->nivel == 'Professor' or  $payload->nivel == 'Usuario'){

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
        }else{
            http_response_code(401);
            echo json_encode(["message"=>"Usuario sem permissão"]);

        }
    }
    public static function delete($id){
        $key = '12345';

        $payload = getToken::getToken($key);

        if($payload->nivel == 'Admin' or $payload->nivel == 'Professor'){
            $db = Database::connect();
            $sql = $db->prepare("DELETE FROM posts WHERE id_post = :id");
            $sql->bindValue(':id', $id , PDO::PARAM_INT);

            $sql->execute();

            successJson($sql);
        }else{
            http_response_code(401);
            echo json_encode(["message"=>"Usuario sem permissão"]);

        }
    }
    public static function getID($id){
        $db = Database::connect();
        $sql = $db->prepare("SELECT * FROM posts WHERE id_post = :id");
        $sql->bindValue(':id', $id, PDO::PARAM_INT);

        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);
    }
      public static function getPostsByUserId($id){
        $db = Database::connect();
        $sql = $db->prepare("SELECT * FROM posts WHERE usuarios_id_usuario = :id");
        $sql->bindValue(':id', $id, PDO::PARAM_INT);

        $sql->execute();
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
    public static function getPostCategoria($id){
        $db = Database::connect();
        $sql = $db->prepare("SELECT * FROM posts WHERE categorias_id_categoria = :id AND status_post = 1");
        $sql->bindValue(':id', $id , PDO::PARAM_INT);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function getPostNull(){
        $key = '12345';

        $payload = getToken::getToken($key);   
        if($payload->nivel == 'Admin' or $payload->nivel == 'Professor'){
            $db = Database::connect(); 
            $sql = $db->prepare("SELECT * FROM posts WHERE status_post = 0");
            $sql->execute();
    
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }else{
            http_response_code(401);
            echo json_encode(["message"=>"Usuario sem permissão"]);

        }

       
    }
    public static function updateStatus($json,$id){
        $key = '12345';

        $payload = getToken::getToken($key);
        if($payload->nivel == 'Admin' or $payload->nivel == 'Professor'){
            $db = Database::connect();
            $sql = $db->prepare("UPDATE posts SET  status_post = :status  WHERE id_post = :id");
            $sql->bindValue(':status',$json['status_post']);
            $sql->bindValue(':id', $id , PDO::PARAM_INT);

            $sql->execute();
            successJson($sql);
        }else{
            http_response_code(401);
            echo json_encode(["message"=>"Usuario sem permissão"]);

        }

    }
    
}


