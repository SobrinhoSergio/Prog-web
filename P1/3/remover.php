<?php

require_once 'lutador.php';
require_once 'repositorio-lutador.php';
require_once 'repositorio-lutador-em-bdr.php';

use Mma\Lutador;
use Mma\LutadorRepositoryBDR;

$servername = "localhost";
$username = "dev";
$password = "123456";
$dbname = "mma";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $repo = new LutadorRepositoryBDR($conn);

    echo "Informe o ID do primeiro lutador: ";
    $id1 = readline();
    
    echo "Informe o ID do segundo lutador: ";
    $id2 = readline();

    $conn->beginTransaction();

    $repo->removerLutadorPorId($id1);
    $repo->removerLutadorPorId($id2);

    $conn->commit();
    
    echo "Lutadores removidos com sucesso.\n";
} catch(PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
    $conn->rollback();
}

$conn = null;

?>
