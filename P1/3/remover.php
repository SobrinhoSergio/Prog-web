<?php

require_once 'lutador.php';
require_once 'repositorio-lutador.php';
require_once 'repositorio-lutador-em-bdr.php';
require_once 'repositorio-exception.php';

use MMA\Lutador;
use MMA\RepositorioLutador;
use MMA\RepositorioLutadorEmBDR;
use MMA\RepositorioException;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cadastro_pessoas_db";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    die ("Erro na conexão: " . $e->getMessage());
}

$repo = new LutadorRepositoryBDR($pdo);

echo "Informe o ID do primeiro lutador: ", PHP_EOL;
$id1 = readline();

echo "Informe o ID do segundo lutador: ", PHP_EOL;
$id2 = readline();

try{

    $pdo->beginTransaction();

    $ok->repo->remover($id1);

    if(!ok){
        $pdo -> roolback();
        return;
    }

    $ok->repo->remover($id2);

    if(!ok){
        $pdo -> roolback();
        return;
    }

    $pdo->commit();
}
catch(RepositorioException $pe){
    $pdo->roolback();
    die($pe->getMessage());
}





echo "Lutadores removidos com sucesso.\n";

$conn = null;

?>
