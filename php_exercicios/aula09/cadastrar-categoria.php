<?php
require_once 'conexao.php';
require_once 'categoria.php';
require_once 'repositorio-categoria.php';

$p = conectar();

$pdo = new RepositorioCategoria($p);

$nome = htmlspecialchars($_POST['nome']);
$cat = new Categoria();
$cat->setNome($nome);
try{
    $pdo->cadastrarCategoria($cat);
    header( 'Location: listar-categorias.php' );
}catch(PDOException $e){
    http_response_code( 500 );
    $e->getMessage();
}

?>