<?php
require_once 'materia-prima.php';

class RepositorioMateriaPrima{
    private $pdo = null;

    function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    function cadastrarMT(MateriaPrima $mt){
        try{
            $sql = 'INSERT INTO materia_prima(descricao, quantidade, custo, categoria_id) 
                  VALUES (:descr, :qtd, :custo, :cat)';
            $ps =$this->pdo->prepare($sql);
            $ps->execute([
                'descr' => $mt->getDescicao(),
                'qtd' => $mt->getQuantidade(),
                'custo' => $mt->getCusto(),
                'cat' => $mt->getCategoria()->getId()
            ]);
            //header( 'Location: contatos.php' );
        }catch(PDOException $e){
            http_response_code( 500 ); // Server Error
            echo 'Erro ao cadastrar uma materia prima.';
        }
    }
}

?>