<?php

// Cliente.php

class Cliente{
    public $id = 0;
    public $nome = '';
    public $telefones = [];

    function __construct($id = 0, $nome = '', $telefones = []){
        $this->nome = $nome;
        $this->id = $id;
        $this->telefones = $telefones;
    }

    function validar(){
        $problemas = [];

        $tamNome = mb_strlen($this->nome);

        if($tamNome < 2 || $tamNome > 100){
            $problemas[] = "Nome inválido!";
        } 

        foreach($this->telefones as $tel){
            $problemasTelefones = $tel->validar();
            foreach($problemasTelefones as $prob){
                $problemas[] = $prob;
            }
        }
        return $problemas;
    }

}

// RepositorioClienteEmBDR.php

class RepositorioClienteEmBdr implements RepositorioCliente{

    private $pdo;

    function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    function cadastrar(Cliente &$c){
        try{
            $this->pdo->beginTransaction();

            $ps = $this->pdo->prepare("INSERT INTO cliente (nome) VALUES (:nome)");

            $ps->execute(['nome' => $c->nome]);

            $c->id = (int) $this->pdo->lastInsertId();

            $ps = $this->pdo->prepare("");
        
        }catch(PDOException $e){
            throw new RepositorioException("Erro ao adicionar cliente");
        }
    }

    function remover($id1, $id2){
        try{

            $ps = $this->pdo->prepare("DELETE FROM cliente WHERE id = :id");

            $ps->execute(['id' => $id]);



        
        }catch(PDOException $e){
  
            throw new RepositorioExceprion("Erro ao excluir");
        }
       
    }


}