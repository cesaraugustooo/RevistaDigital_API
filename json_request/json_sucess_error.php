<?php

function successJson($sql){
    
    if($sql->rowCount() > 0){
        header('Content-Type: application//json');
        $mensagem = [
            "status" => "Sucesso!"
        ];
        echo json_encode($mensagem);
    }else{
        header('Content-Type: application//json');
        $mensagem = [
            "status" => "Dados invalido"
        ];
        echo json_encode($mensagem);
    }

}