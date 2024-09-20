<?php

require_once 'fornecedor.php';
require_once 'repositorio-fornecedor.php';

use \acme\RepositorioException;
use \acme\RepositorioFornecedor;

class RepositorioFornecedorEmBDR implements RepositorioFornecedor{

    private $pdo = null;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function todos(string $filtro = ''){
        $fornecedor = [];

        try{
            $ps = $this->pdo->prepare('SELECT * FROM fornecedor WHERE 
                (id like :id) or
                (codigo like :codigo) or
                (nome like :nome) or
                (cnpj like :cnpj) or
                (email like :email) or
                (telefone like :telefone)
            ');

            $pesquisa = '%'.filtro.'%';

            $ps->execute([
                'id' => $pesquisa,
                'codigo' => $pesquisa,
                'nome' => $pesquisa,
                'cnpj' => $pesquisa,
                'email' => $pesquisa,
                'telefone' => $pesquisa,
            ]);

            foreach ($ps as $ry){
                $fornecedor[] = new Fornecedor($ry);
            }
            return $fornecedor;
        }
        catch(PDOException $e){
            throw new RepositorioException('Erro ao buscar fornecedor', $e->getMessage());
        }
    }

    public function cadastrar (Fornecedor & $fornecedor){
        try{
            $ps = $this->pdo->prepare('INSERT INTO fornecedor (codigo, nome, cnpj, email, telefone) VALUES (:codigo, :nome, :cnpj, :email, :telefone)'); 

            $ps = $this->pdo->query('SELECT MAX(id) FROM fornecedor');

            $ps->execute([
                'id' => $fornecedor->id,
                'codigo' => $fornecedor->codigo,
                'nome' => $fornecedor->nome,
                'cnpj' => $fornecedor->cnpj,
                'email' => $fornecedor->email,
                'telefone' => $fornecedor->telefone,
            ]);

            $id = $ps->fetch(PDO::FETCH_ASSOC);
            
            $fornecedor->id = $id;
        
        }catch (PDOException $e){
            throw new RepositorioException('Erro ao cadastrar fornecedor', $e->getMessage());
        }
    }

    public function atualizar (Fornecedor $fornecedor){
        try{
            $ps = $this->pdo->prepare('UPDATE fornecedor SET codigo = :codigo,  nome = :nome, cnpj = :cnpj, email = :email, telefone = :telefone'); 

            $ps->execute([
                'id' => $fornecedor->id,
                'codigo' => $fornecedor->codigo,
                'nome' => $fornecedor->nome,
                'cnpj' => $fornecedor->cnpj,
                'email' => $fornecedor->email,
                'telefone' => $fornecedor->telefone,
            ]);
        
        }catch (PDOException $e){
            throw new RepositorioException('Erro ao atualizar fornecedor', $e->getMessage());
        }
    }

    public function remover (string $idOuCodigo){
        try{
            $ps = $this->pdo->prepare('DELET FROM fornecedor (id = :id) or (codigo = :codigo)'); 

            $ps->execute([
                'id' => $idOuCodigo,
                'codigo' => $idOuCodigo,
            ]);
        
        }catch (PDOException $e){
            throw new RepositorioException('Erro ao deletar fornecedor', $e->getMessage());
        }
    }

    
}



