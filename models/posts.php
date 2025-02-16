<?php
require_once 'database.php';

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
        
        successJson($sql,'Postagem');


    }
}


