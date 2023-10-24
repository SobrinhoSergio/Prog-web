<?php

function conectar() {
    return new PDO(
        'mysql:dbname=cadastro_pessoas_db;
         host=localhost;
         charset=utf8',
        'root',
        '',
        [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ]
    );
}

?>