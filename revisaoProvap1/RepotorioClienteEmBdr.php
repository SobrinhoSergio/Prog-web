<?php

require_once 'RepositorioCliente.php';
require_once 'RepositorioException.php';
require_once 'Cliente.php';

class RepositorioClienteEmBdr implements RepositorioCliente{

    private $pdo = null;

    function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    function adicionar(Cliente $cliente){
        try{
            $this->pdo->beginTransaction();

            $ps = $this->pdo->prepare("INSERT INTO cliente (nome) VALUES (:nome)");
            
            $pss = $this->pdo->prepare("INSERT INTO cliente_telefone (numero) VALUES (:numero)");

            $ps->execute(['nome' => $cliente->getNome()]);

            if($ps->rowCount() < 1){
                $this->pdo->rollback();
                return;
            }

            $pss->execute(['numero' => $cliente->getNumero()]);

            if($pss->rowCount() < 1){
                $this->pdo->rollback();
                return;
            }

            $this->pdo->commit();
            
        }catch(PDOException $e){
            $this->pdo->rollback();
            throw new RepoitorioException("Erro ao cadastrar: " .$e->getMessage());
        }
    }

    function removerPeloId(int $id){
        try{
            $ps = $this->pdo->prepare("DELETE FROM cliente WHERE id = :id");
            $ps->execute(['id' => $id]);

            if($ps->rowCount()<1){
                return false;
            }
            return true;
        }catch(PDOException $e){
            throw new RepoitorioException("Erro ao deletar: " .$e->getMessage());
        }
    }

    function todos(){
        try{
            $ps = $this->pdo->prepare("SELECT c.id, c.nome, t.telefone FROM cliente c JOIN telefone t ON t.cliente_id = c.id ");
        
            $registro = $ps->fetchAll();

            $c = [];

            foreach($registro as $r){
                $c[] = new Cliente(
                    $r['id'],
                    $r['nome'],
                    $r['telefone']
                );
            }
            return $c;
        }
        catch(PDOException $e){
            throw new RepositorioException("Erro ao listar: " .$e->getMessage());
        }
    }

}