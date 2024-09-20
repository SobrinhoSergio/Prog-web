<?php
require_once 'RepositorioConta.php';
require_once 'Conta.php';

class RepositorioContaEmBDR implements RepositorioConta {

    private $pdo;

    public function __construct( PDO $pdo ) {
        $this->pdo = $pdo;
    }

    function adicionar(Conta $conta) {

        try{

            $ps = $this->pdo->prepare("INSERT INTO conta ( descricao, valor ) VALUES
            ( :descricao, :valor )");
        
            $ps->execute( [
                'descricao' => $conta->descricao,
                'valor' => $conta->valor
            ] );

            $conta->id = (int) $this->pdo->lastInsertId();

        }catch(PDOException $e){
            Throw new RepositorioException("Erro ao adicionar: " . $e->getMessage);
        }


    }

    function obterPorId(){
        $ps = $this->pdo->prepare("SELECT id, descricao, valor FROM Conta WHERE id = :id");

        $ps->execute(['id' => $id]);

        $r = $ps->fetch();

        if (!$r) {
            return null;
        }
        
        $conta = new Conta(
            $r['id'], 
            $r['descricao'],
            $r['valor']
        );

        return $conta;

    }

    function remover($id){

        try{

            $ps = $this->pdo->prepare("DELETE FROM conta WHERE id = :id");

            $ps->execute([':id' => $id]);
    
            if($ps->rowCount() < 0){
                return false;
            }
            else{
                return true;
            }

        }catch(PDOException $e){
            Throw new RepositorioException("Erro ao deletar: " . $e->getMessage);
        }

    }

    public function atualizar(Conta $c){
        try{

            $ps = $this->pdo->prepare("UPDATE conta SET descricao = :descricao, valor = :valor WHERE id = :id");

            $ps->execute([
                ':descricao' => $e->descricao,
                ':valor' => $c->valor
            ]);

        }catch(PDOException $e){
            throw new RepositorioException("Erro ao atualizar: " . $e->getMessage());
        }

    }

}