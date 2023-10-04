<?php

require_once 'conexao.php';
require_once 'CrudException.php';

use excecoes\CrudException; 

class Crud {
    private $pdo = null;

    public function __construct(PDO $pdo) {
        $this->pdo = Conexao::conectar();
    }

    public function cadastrar($descricao, $feita) {
        try {
            $ps = $this->pdo->prepare('INSERT INTO tarefa (descricao, feita) VALUES (:descricao, :feita)');
            
            $ps->execute(['descricao' => $descricao, 'feita' => $feita]);

            return 'Inserido com sucesso.';
        } catch (PDOException $e) {
          
            throw new CrudException('Erro ao cadastrar tarefa: ');
        }
    }

    public function listar() {
        try {
            $ps = $this->pdo->prepare('SELECT * FROM tarefa');
            $ps->execute();

            $tarefas = [];
            foreach ($ps as $tarefa) {
                $tarefas[] = [
                    'id' => $tarefa['id'],
                    'descricao' => $tarefa['descricao'],
                    'feita' => $tarefa['feita'] ? 'Sim' : 'Não'
                ];
            }

            return $tarefas;
        } catch (PDOException $e) {
            throw new CrudException('Erro ao listar tarefas: ');
        }
    }

    public function remover($id) {
        try {
            $ps = $this->pdo->prepare('DELETE FROM tarefa WHERE id = :id');
            $ps->execute(['id' => $id]);

            return 'Removido com sucesso.';
            
        } catch (PDOException $e) {

            throw new CrudException('Erro ao remover tarefa: ');
        }
    }

    public function pesquisar(string $filtro = '') {
        $fornecedores = [];
    
        try {
            $ps = $this->pdo->prepare('SELECT * FROM fornecedor WHERE 
                (id like :id) or
                (codigo like :codigo) or
                (nome like :nome) or
                (cnpj like :cnpj) or
                (email like :email) or
                (telefone like :telefone)
            ');
    
            $pesquisa = '%' . $filtro . '%';
    
            $ps->execute([
                'id' => $pesquisa,
                'codigo' => $pesquisa,
                'nome' => $pesquisa,
                'cnpj' => $pesquisa,
                'email' => $pesquisa,
                'telefone' => $pesquisa,
            ]);
    
            foreach ($ps as $row) {
                $fornecedores[] = new Fornecedor($row['id'], $row['codigo'], $row['nome'], $row['cnpj'], $row['email'], $row['telefone']);
            }
            return $fornecedores;
        } catch (PDOException $e) {
            throw new CrudException('Erro ao buscar fornecedores: ');
        }
    }

    public function pesquisar1($descricao) {
        try {
            $ps = $this->pdo->prepare('SELECT * FROM tarefa WHERE descricao LIKE :descricao');
            $ps->execute(['descricao' => '%' . $descricao . '%']);

            $tarefas = [];
            foreach ($ps as $tarefa) {
                $tarefas[] = [
                    'id' => $tarefa['id'],
                    'descricao' => $tarefa['descricao'],
                    'feita' => $tarefa['feita'] ? 'Sim' : 'Não'
                ];
            }

            return $tarefas;
        } catch (PDOException $e) {
            throw new CrudException('Erro ao pesquisar tarefas: ');
        }
    }

    public function editar($id, $novaDescricao) {
        try {
            $ps = $this->pdo->prepare('UPDATE tarefa SET descricao = :descricao WHERE id = :id');
            
            $ps->execute(['id' => $id, 'descricao' => $novaDescricao]);

            return 'Descrição atualizada com sucesso.';
        } catch (PDOException $e) {
            throw new CrudException('Erro ao atualizar descrição: ');
        }
    }
    
}

?>
