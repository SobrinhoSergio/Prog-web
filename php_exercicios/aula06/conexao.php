<?php
  function conectar(){
    return new PDO('
                    mysql:dbname=bd_produtos;
                    host=localhost;
                    charset=utf8',
                    'root',
                    '', 
                    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
                  );
  }
?>