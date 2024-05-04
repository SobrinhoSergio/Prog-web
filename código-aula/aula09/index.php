<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

        //header('Content-Type: text/plain'); //Texto Simples
        echo 'Hello, <br /> World';

    ?>
</body>
</html>

<?php

function conectar(){
    return new PDO(
        "mysql:host=localhost;dbname=cadastro_pessoas_db;charset=utf8",
        'root',
        '',
        [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ] 
    );
}