<?php
    require_once 'materia-prima.php';
    require_once 'categoria.php';
    require_once 'conexao.php';

    class RepositorioCategoria{
        private $pdo = null;

        function __construct(PDO $pdo){
            $this->pdo = $pdo;
        }

        function cadastrarCategoria(Categoria $c){
            try{
                $sql = 'INSERT INTO categoria(nome) 
                      VALUES (:nome)';
                $ps =$this->pdo->prepare($sql);
                $ps->execute(['nome' => $c->getNome()]);
                //header( 'Location: contatos.php' );
            }catch(PDOException $e){
                throw $e;
            }
        }

        function listar(){
            try{
                $ps = $this->pdo->query('SELECT * FROM categoria');
                return $ps;
            }catch(PDOException $e){
                throw $e;
            }
        }

        function listarUm($nome){
            try{
                $sql ="SELECT id, nome FROM categoria WHERE nome = :nome";
                $ps = $this->pdo->prepare($sql);
                $ps->execute(['nome' => $nome]);
                if($ps->rowCount() < 1){
                    return null;
                }
                $reg = $ps->fetch(PDO::FETCH_ASSOC);
                return new Categoria($reg['id'], $reg['nome']);
            }catch(PDOException $e){
                throw $e;
            }
        }

        
    }
?>