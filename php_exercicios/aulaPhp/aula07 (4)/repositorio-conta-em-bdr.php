<?php
require_once 'repositorio-conta.php';
require_once 'conta.php';

class RepositorioContaEmBDR implements RepositorioConta {

    private $pdo = null;

    function __construct( PDO $pdo ) {
        $this->pdo = $pdo;
    }

    function cadastrar( Conta $conta ) {
        try {
            $sql = 'INSERT INTO conta ( dono, cpf, senha, saldo )
                VALUES ( :dono, :cpf, :senha, :saldo )';
            $ps = $this->pdo->prepare( $sql );
            $ps->execute( [
                'dono'   => $conta->dono,
                'cpf'    => $conta->cpf,
                'senha'  => meuHash( $conta->senha ),
                'saldo'  => $conta->saldo
            ] );
        } catch ( PDOException $e ) {
            throw new RepositorioException(
                'Erro ao cadastrar a conta.', $e->getCode(), $e );
        }
    }


    function todasAsContas() {
        try {
            $ps = $this->pdo->prepare( 'SELECT id, dono, cpf, saldo FROM conta' );
            $ps->setFetchMode( PDO::FETCH_ASSOC ); // Só o nome das colunas
            $ps->execute();
            $contas = []; // Objetos de Conta
            foreach ( $ps as $reg ) {
                $contas []= new Conta(
                    $reg[ 'id' ],
                    $reg[ 'dono' ],
                    $reg[ 'cpf' ],
                    '',
                    $reg[ 'saldo' ],
                );
            }
            return $contas;
        } catch ( PDOException $e ) {
            throw new RepositorioException(
                'Erro ao consultar as contas.', $e->getCode(), $e );
        }
    }


    function depositar( $cpf, $senha, $valor ) {
        try {
            $sql = 'UPDATE conta SET saldo = saldo + :valor
                WHERE cpf = :cpf AND senha = :senha';
            $ps = $this->pdo->prepare( $sql );
            $ps->execute( [
                'cpf' => $cpf,
                'senha' => meuHash( $senha ),
                'valor' => $valor
                ] );
            if ( $ps->rowCount() < 1 ) { // Não encontrado
                return false;
            }
            return true;
        }  catch ( PDOException $e ) {
            throw new RepositorioException(
                'Erro ao realizar um depósito na conta.', $e->getCode(), $e );
        }
    }


    function retirar( $cpf, $senha, $valor ) {
        try {
            $sql = 'UPDATE conta SET saldo = saldo - :valor
                WHERE cpf = :cpf AND senha = :senha AND saldo >= :valor';
            $ps = $this->pdo->prepare( $sql );
            $ps->execute( [
                'cpf' => $cpf,
                'senha' => meuHash( $senha ),
                'valor' => $valor
                ] );
            if ( $ps->rowCount() < 1 ) { // Não encontrado
                return false;
            }
            return true;
        }  catch ( PDOException $e ) {
            throw new RepositorioException(
                'Erro ao realizar uma retirada da conta.', $e->getCode(), $e );
        }
    }


    function depositarNaoIndicado( $cpf, $senha, $valor ) {
        $sql = 'SELECT saldo FROM conta WHERE cpf = :cpf AND senha = :senha';
        $ps = $this->pdo->prepare( $sql );
        $ps->execute( [ 'cpf' => $cpf, 'senha' => meuHash( $senha ) ] );
        if ( $ps->rowCount() < 1 ) { // Não encontrado
            return false;
        }
        $registro = $ps->fetch( PDO::FETCH_ASSOC ); // [ 'saldo' => 100.00 ]
        $novoSaldo = $registro[ 'saldo' ] + $valor;
        $sql = 'UPDATE conta SET saldo = :saldo WHERE cpf = :cpf';
        $ps = $this->pdo->prepare( $sql );
        $ps->execute( [ 'cpf' => $cpf, 'saldo' => $novoSaldo ] );
        if ( $ps->rowCount() < 1 ) { // Não encontrado
            return false;
        }
        return false;
    }


    function transferir(
        $cpfOrigem,
        $senhaOrigem,
        $cpfDestino,
        $senhaDestino,
        $valor
    ) {
        try {
            $this->pdo->beginTransaction();

            $ok = $this->retirar( $cpfOrigem, $senhaOrigem, $valor );
            if ( ! $ok ) { // Não encontrou, etc.
                $this->pdo->rollBack();
                throw new ContaException( 'Conta origem inexistente ou saldo insuficiente.' );
            }

            $ok = $this->depositar( $cpfDestino, $senhaDestino, $valor );
            if ( ! $ok ) { // Não encontrou, etc.
                $this->pdo->rollBack();
                throw new ContaException( 'Conta destino inexistente ou saldo insuficiente.' );
            }

            $this->pdo->commit();

            return true;
        } catch ( PDOException $e ) {
            $this->pdo->rollBack();
            throw new RepositorioException(
                'Erro ao realizar a transferência entre contas.', $e->getCode(), $e );
        }
        // Alternativa ao colocar nos IFs:
        // } finally {
        //     if ( $this->pdo->inTransaction() ) {
        //         $this->pdo->rollBack();
        //     }
        // }
    }

}


function meuHash( $conteudo ) {
    $conteudoComSal = '29372dsk#)@(#*' . $conteudo . '*&%¨&#@)#?+';
    return hash( 'sha256', $conteudoComSal );
}

?>