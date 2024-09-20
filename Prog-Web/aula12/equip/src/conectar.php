<?php

function conectar(){
    return new PDO(
        "mysql:host=localhost;dbname=faculdade_teste;charset=utf8",
        'root',
        '',
        [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ] 
    );
}