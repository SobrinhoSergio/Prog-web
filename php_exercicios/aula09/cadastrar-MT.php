<?php
require_once 'conexao.php';
require_once 'repositorio-materia-prima.php';
require_once 'materia-prima.php';
require_once 'categoria.php';
require_once 'repositorio-categoria.php';

$p = conectar();

$pdo = new RepositorioMateriaPrima($p);
$descricao = htmlspecialchars($_POST['descricao']);
$quantidade = htmlspecialchars($_POST['quantidade']);
$custo = htmlspecialchars($_POST['custo']);
$categoria = htmlspecialchars($_POST['categoria']);

try{
    $pdoCat = new RepositorioCategoria($p);
    $c = $pdoCat->listarUm($categoria);

}catch(PDOException $e){
    http_response_code( 500 );
    $e->getMessage();
}

echo <<<HTML
    <p>$c->getId() - $c->getNome()</p>
HTML;
?>