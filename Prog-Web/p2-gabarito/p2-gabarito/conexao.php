<?php
function conectar() {
    $opcoes = [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ];
    // return new PDO(
    //     'mysql:dbname=p2;host=192.168.1.1;charset=utf8',
    //     'dev',
    //     'while(1);',
    //     $opcoes
    // );
    return new PDO(
        'mysql:dbname=p2;host=localhost;charset=utf8',
        'root',
        '',
        $opcoes
    );
}