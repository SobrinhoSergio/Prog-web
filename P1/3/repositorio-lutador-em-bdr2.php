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

    function atualizarLutador(int $id, Lutador $lutador) {
        try {
            $sql = "UPDATE lutador 
                    SET nome = :nome, peso_em_quilos = :peso, altura_em_metros = :altura 
                    WHERE id = :id";

            $ps = $this->pdo->prepare($sql);
            $ps->execute([
                ':id' => $id,
                ':nome' => $lutador->nome,
                ':peso' => $lutador->pesoEmQuilos,
                ':altura' => $lutador->alturaEmMetros
            ]);

            if ($ps->rowCount() < 1) {
                return false; // Nenhum registro atualizado
            }
            return true;

        } catch (PDOException $e) {
            throw new RepositorioException("Erro ao atualizar lutador ", $e->getCode(), $e);
        }
    }

    function listar() {
        try {
            $query = "SELECT * FROM lutador";
            $ps = $this->pdo->prepare($query);

            $ps->fetch(PDO::FETCH_ASSOC);
            
            $ps->execute();
            
            $c = [];
            
            foreach($ps as $reg){
                $c []= new Conta(
                    $reg['id'],
                    $reg['nome'],
                    $reg['altura'],
                    $reg['peso']
                );
            }
            return $c;

        } catch (PDOException $e) {
            throw new RepositorioException("Erro ao exibir lutador ", $e->getCode(), $e);
        }
    }
}

?>
