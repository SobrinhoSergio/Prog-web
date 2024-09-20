<?php

require_once "conexao.php";
require_once "RepositorioFrasesEmBDR.php";
require_once "RepositorioFrases.php";
require_once "listagem.php";

use \acme\FraseComAutor;

$url = htmlspecialchars($_SERVER['REQUEST_URI']);
$metodo = htmlspecialchars($_SERVER['REQUEST_METHOD']);

if($metodo === "GET" && preg_match('/^\/frases\/?$/i', $url)){
    listagemFrases();
} 

else if($metodo === "DELETE" && preg_match('/^\/frases\/([0-5]+)$/i', $url, $casamentos)){
    
    $pdo = null;

    try{

        $pdo = conectar();
        
        $repositorio = new RepositorioFrasesEmBDR($pdo);
        
        [, $nota] = $casamentos;

        $repositorio->removerFrasesComNotaMenorOuIgualA($nota);

        http_response_code(204);

    }catch (Exception $e) {
        http_response_code(500);
        die("Erro ao acessar o banco de dados: " . $e->getMessage());
    }
}  




