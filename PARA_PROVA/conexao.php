<?php

// Conexao.php

class Conexao {
    public static function conectar() {
        return new PDO("mysql:host=localhost;
                        dbname=cadastro_pessoas_db;
                        charset=utf8", 
                        'root',
                        '',
                        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
                    );
    }
}
