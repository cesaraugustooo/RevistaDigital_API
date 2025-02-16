<?php

class Database
{
    public static function connect(){
        $connect = new PDO('mysql:host=localhost;dbname=blog', "root", "");

        return $connect;
    }
}