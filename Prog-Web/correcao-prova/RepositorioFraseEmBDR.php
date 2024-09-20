<?php
require_once 'RepositorioFrases.php';

use \acme\RepositorioException;
use \acme\RepositorioFrase;
use \acme\RepositorioComAutor;


class RepositorioEquipamentoEmBDR implements RepositorioFrases{

    private $pdo;

    public function __construct( PDO $pdo ) {
        $this->pdo = $pdo;
    }


    public function frasesComAutor(){
        
        try{

            $ps = $this->pdo->prepare("
                SELECT f.id, f.texto, f.nota, a.nome
                FROM frase f JOIN autor a 
                ON f.autor_id = a.id;
            ");
        
            $ps->execute(); 
            
            $registros =  $ps->fetchAll();
            
            $frases = [];
            
            foreach ( $registros as $r ) {
                
                $frases [] = new FrasesComAutor(
                    $r[ 'id' ], 
                    $r[ 'texto' ], 
                    $r[ 'nota'],
                    $r[ 'autor' ]
                );
            }
            return $frases;

        }catch(PDOException $e){
            Throw new RepositorioException("Erro ao Listar: " . $e->getMessage);
        }
        
    }

    public function removerFrasesComNotaMenorOuIgualA(int $nota){
        
        try{
            $pdo = beginTransaction();

            $ps = $this->pdo->prepare("DELETE FROM frase WHERE nota = ? OR nota < ?");

            $ps->execute([$nota, $nota]);

            $pdo->commit();

        }catch(PDOException $e){

            $pdo->rollback();
            
            Throw new RepositorioException("Erro ao deletar: " . $e->getMessage);
        }
    }

}