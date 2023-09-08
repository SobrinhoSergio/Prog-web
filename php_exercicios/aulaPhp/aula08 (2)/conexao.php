<?php
function criarConexao() {
    return new PDO(
        'mysql:dbname=aula08;host=localhost:3308;charset=utf8',
        'root', '', [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ]
    );
}
?>