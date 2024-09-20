<?php

function conectar(){

    return new PDO(
        "mysql:host=localhost;dbname=p2;charset=utf8",
        'root',
        'senha123',
        [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ] 
    );

}