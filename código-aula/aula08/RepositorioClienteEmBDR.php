<?php
require_once 'RepositorioCliente.php';
require_once 'RepositorioException.php';
require_once 'Telefone.php';

class RepositorioClienteEmBDR implements RepositorioCliente {

    private $pdo;

    public function __construct( PDO $pdo ) {
        $this->pdo = $pdo;
    }

    function adicionar( Cliente &$c ) {

        // Verifica se algum telefone existe, já que o telefone é único na tabela.
        foreach ( $c->telefones as $tel ) {
            if ( $this->telefoneExiste( $tel->numero ) ) {
                throw new RepositorioException( "O telefone \"$tel->numero\" já existe." );
            }
        }

        try {
            $this->pdo->beginTransaction();

            $ps = $this->pdo->prepare( 'INSERT INTO cliente ( nome ) VALUES ( :nome )' );
            
            $ps->execute( [ 'nome' => $c->nome ] );
            
            $c->id = (int) $this->pdo->lastInsertId();

            $ps = $this->pdo->prepare( 'INSERT INTO cliente_telefone ( numero, cliente_id ) VALUES ( :numero, :cliente_id )' );
            
            foreach ( $c->telefones as $tel ) {
                $ps->execute([ 'numero' => $tel->numero, 
                               'cliente_id' => $c->id 
                            ]);
            }

            $this->pdo->commit();

        }catch ( PDOException $e ) {
            
            if ( $this->pdo->inTransaction() ) {
                $this->pdo->rollBack();
            }
            throw new RepositorioException( 'Erro ao adicionar o cliente.' );
        }
    }


    function removerPeloId( $id ) {
        try {
            $ps = $this->pdo->prepare( 'DELETE FROM cliente WHERE id = :id' );
            
            $ps->execute( [ 'id' => $id ] );
            
            if ( $ps->rowCount() < 1 ) {
                throw new RepositorioException( 'Cliente não encontrado.' );
            }
        
        } catch ( PDOException $e ) {
            throw new RepositorioException( 'Erro ao remover o cliente.' );
        }
    }


    function todos() {
        try {

            $ps = $this->pdo->prepare( 'SELECT * FROM cliente' );
            
            $ps->execute();
            
            $registros = $ps->fetchAll();
            
            $clientes = [];
            
            foreach ( $registros as $r ) {
                $clientes []= new Cliente(
                    $r[ 'id' ],
                    $r[ 'nome' ],
                    $this->telefonesDoClienteComId( $r[ 'id' ] )
                );
            }
            return $clientes;
        
        } catch ( PDOException $e ) {
            throw new RepositorioException( 'Erro ao consultar os clientes.' );
        }
    }

    private function telefoneExiste( $numero ) {
        try {
            
            $ps = $this->pdo->prepare( 'SELECT id FROM cliente_telefone WHERE numero = :numero' );
            
            $ps->execute( [ "numero" => $numero ] );
            
            if ($ps->rowCount() > 0) {
                return true;
            } 
            
            else{
                return false;
            }            
        
        } catch ( PDOException $e ) {
            throw new RepositorioException( 'Erro ao consultar o telefone.' );
        }
    }

    private function telefonesDoClienteComId( $idCliente ) {
        try {   
            $ps = $this->pdo->prepare( 'SELECT id, numero FROM cliente_telefone WHERE cliente_id = :cliente_id' );
            
            $ps->execute( [ "cliente_id" => $idCliente ] );
            
            $registros = $ps->fetchAll();
            
            $telefones = [];
            
            foreach ( $registros as $r ) {
                $telefones []= new Telefone( 
                    $r[ 'id' ], 
                    $r[ 'numero' ] 
                );
            }
            
            return $telefones;
        
        } catch ( PDOException $e ) {
            throw new RepositorioException( 'Erro ao consultar os clientes.' );
        }
    }

}

?>