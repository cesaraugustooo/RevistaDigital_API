<?php

try{
    header('Content-Type: application/json');
    $dirImg = 'C:/xampp/htdocs/RevistaDigital_API/images/';
    $fileName = basename($_FILES['file']['name']);
    move_uploaded_file($_FILES['file']['tmp_name'], $dirImg.$fileName);

    echo json_encode(['message'=>'Dowload de imagem realizado com sucesso!!']);

}catch(Error $e){
    echo json_encode(["error" => $e->getMessage()]);  

}
