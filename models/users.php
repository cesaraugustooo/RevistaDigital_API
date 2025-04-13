<?php
require_once 'C:\xampp\htdocs\RevistaDigital_API\database.php';
require_once 'C:\xampp\htdocs\RevistaDigital_API\json_request\json_sucess_error.php';

class UserModel
{
    public static function postUsers($json){
        $db = Database::connect();
        $sql = $db->prepare("INSERT INTO usuarios VALUES(null,:user,:senha,:nivel,:foto)");
        $sql->bindValue(':user', $json['user_usuario']);
        $sql->bindValue(':senha', $json['senha_usuario']);
        $sql->bindValue(':nivel', $json['nivel']);
        $sql->bindValue(':foto','http://localhost/RevistaDigital_API/images/default.png');

        $sql->execute();
 
        successJson($sql);

    }
    public static function getUsers(){
        $db = Database::connect();
        $sql = $db->prepare("SELECT * FROM usuarios");
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);

    }
    public static function updateUser($json,$id){
        $db = Database::connect();
        $sql = $db->prepare("UPDATE usuarios SET :foto WHERE id_usuario = :id");
        $sql->bindValue(':foto', $json['foto_usuario']);
        $sql->bindValue(':id', $id , PDO::PARAM_INT);
        
        $sql->execute();

        successJson($sql);
    }
    public static function getUserById($id) {
        $db = Database::connect();
        $sql = $db->prepare("SELECT * FROM usuarios WHERE id_usuario = :id");
        $sql->bindValue(':id', $id, PDO::PARAM_INT);

        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);
    }
    
}


// CREATE TABLE `usuarios` (
//     `id_usuario` int NOT NULL AUTO_INCREMENT,
//     `user_usuario` varchar(150) NOT NULL,
//     `senha_usuario` varchar(8) NOT NULL,
//     `nivel` enum('Usuario','Professor','Admin') NOT NULL,
//     PRIMARY KEY (`id_usuario`)
//   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
//   /*!40101 SET character_set_client = @saved_cs_client */;