<?php

function conectar() {
    return new PDO(
        'mysql:dbname=aula10;host=localhost;charset=utf8',
        'root',
        '',
        [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ]
    );
}
?>