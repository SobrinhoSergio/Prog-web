<?php
require_once 'RepositorioEquipamento.php';
require_once 'RepositorioException.php';

class RepositorioEquipamentoEmBDR implements RepositorioEquipamento{

    private PDO $pdo;

    public function __construct( PDO $pdo ) {
        $this->pdo = $pdo;
    }

    public function equipamentos(){
        
        try{

            $ps = $this->pdo->prepare("
                SELECT
                    e.id, codigo, e.descricao, situacao, cadastro,
                    categoria_id, c.descricao AS 'descricao_categoria'
                FROM equipamento e JOIN categoria c
                ON c.id = e.categoria_id
            ");
        
            $ps->execute(); 
            
            $registros =  $ps->fetchAll();
            
            $equipamentos = [];
            
            foreach ( $registros as $r ) {
                
                $c = new Categoria( 
                    $r[ 'categoria_id' ], 
                    $r[ 'descricao_categoria' ]);

                $equipamentos [] = new Equipamento(
                    $r[ 'id' ], 
                    $r[ 'codigo' ], 
                    $r[ 'descricao'],
                    $r[ 'situacao' ],
                    new DateTime( $r[ 'cadastro' ] ),
                    $c
                );
            }
            return $equipamentos;

        }catch(PDOException $e){
            Throw new RepositorioException("Erro ao Listar: " . $e->getMessage);
        }
        
    }

    public function equipamentoComId(int $id){
    
        $ps = $this->pdo->prepare("
            SELECT
                e.id, codigo, e.descricao, situacao, cadastro,
                categoria_id, c.descricao AS 'descricao_categoria'
            FROM equipamento e JOIN categoria c 
            ON c.id = e.categoria_id
            WHERE e.id = :id
        ");

        $ps->execute(['id' => $id]);

        $r = $ps->fetch();

        if (!$r) {
            return null;
        }
        
        $categoria = new Categoria(
            $r['categoria_id'], 
            $r['descricao_categoria']
        );

        $equipamento= new Equipamento(
            $r['id'], 
            $r['codigo'], 
            $r['descricao'], 
            $r['situacao'],
            new DateTime($r['cadastro']),
            $categoria
        );

        return $equipamento;
        
    }



    public function adicionar(Equipamento $e){

        try{
        
            $ps = $this->pdo->prepare("INSERT INTO equipamento (codigo, descricao, situacao, cadastro, categoria_id) VALUES (:codigo, :descricao, :situacao, :cadastro, :categoria_id)");

            $ps->execute([
                ':codigo' => $e->codigo,
                ':descricao' => $e->descricao,
                ':situacao' => $e->situacao,
                ':cadastro' => $e->cadastro->format('Y-m-d H:i:s'),
                ':categoria_id' => $e->categoria->id
            ]);

            $e->id = (int) $this->pdo->lastInsertId();

        }catch(PDOException $e){
            Throw new RepositorioException("Erro ao adicionar: " . $e->getMessage);
        }

    }

    public function removerPeloId(int $id){
        
        try{
            $ps = $this->pdo->prepare("DELETE FROM equipamento WHERE id = :id");

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


    public function atualizar(Equipamento $e){
        try {
            $ps = $this->pdo->prepare("UPDATE equipamento SET codigo = :codigo, descricao = :descricao,situacao = :situacao, cadastro = :cadastro, categoria_id = :categoria_id WHERE id = :id");
    
            $ps->execute([
                ':codigo' => $e->codigo,
                ':descricao' => $e->descricao,
                ':situacao' => $e->situacao,
                ':cadastro' => $e->cadastro->format('Y-m-d H:i:s'),
                ':categoria_id' => $e->categoria->id,
            ]);
    
        } catch (PDOException $e) {
            throw new RepositorioException("Erro ao atualizar: " . $e->getMessage());
        }
    }
    

}