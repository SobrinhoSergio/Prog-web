<?php
declare(strict_types=1);
require_once 'Categoria.php';

class RepositorioCategoriaEmBDR {

    private PDO $pdo;

    public function __construct( PDO $pdo ) {
        $this->pdo = $pdo;
    }

    public function categorias(): array {
        
        $ps = $this->pdo->prepare('SELECT id, descricao FROM categoria');
        
        $ps->execute();
        
        $registros = $ps->fetchAll();
        
        $categorias = [];
        
        foreach ($registros as $r) {
            $categorias[] = new Categoria(
                $r['id'], 
                $r['descricao']
            );
        }
        
        return $categorias;
    }
    
    public function categoriaComId (int $id): ?Categoria{
        
        $ps = $this->pdo->prepare('SELECT id, descricao FROM categoria WHERE id = :id');
        
        $ps->execute(['id' => $id]);
    
        $r = $ps->fetch();
        
        if ( ! $r ) {
            return null; // Retorna null se não encontrou
        }
        
        return new Categoria( 
            $r[ 'id' ], 
            $r[ 'descricao' ] 
        );
    }    
}