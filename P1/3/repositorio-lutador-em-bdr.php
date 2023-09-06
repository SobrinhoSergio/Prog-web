<?php

namespace Mma;

require_once 'Lutador.php';
require_once 'repositorio-lutador.php';
require_once 'repositorio-exception.php';

use \PDO;
use \PDOException;
use \RepositorioException;

class LutadorRepositoryBDR implements RepositorioLutador {
    private $pdo = null;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    function adicionarLutador(Lutador $lutador) {
        try{
            $sql = "INSERT INTO lutador (nome, peso_em_quilos, altura_em_metros) 
            VALUES (:nome, :peso, :altura)";

            $ps = $this->pdo->prepare($sql);
            $ps->execute([
                ':nome' => $lutador->nome,
                ':peso' => $lutador->pesoEmQuilos,
                ':altura' => $lutador->alturaEmMetros
            ]);
        }
        catch(PDOException $e){
            throw new RepositorioException("Erro ao inserir lutador ", $e->getCode(), $e);
        }
    }

    function remover(int $id) {
        try {
            $query = "DELETE FROM lutador WHERE id = :id";
            $ps = $this->pdo->prepare($query);
            $ps->execute([':id' => $id]);

            if($ps->rowCount() < 1) {
                return false;
            }
            return true;

        }catch (PDOException $e) {
            throw new RepositorioException("Erro ao remover lutador ", $e->getCode(), $e);
        }
    }
}

?>
