<?php
require_once 'Conta.php';
require_once 'RepositorioConta.php';
require_once 'DominioException.php';

class GestorConta {

    private $repositorio;

    function __construct( RepositorioConta $repositorio) {
        $this->repositorio = $repositorio;
    }

    // Aqui sendo o modelo, o programador tem que garantir que esses dados vem de fato, e aqui que ele irá Cadastrar os dados

    function adicionarConta( $dados ) {

        if ( ! isset( $dados[ 'descricao' ] ) ) {
            throw new DominioException( 'Descrição não encontrada.' );
        }

        if ( ! isset( $dados[ 'valor' ] ) ) {
            throw new DominioException( 'Valor não encontrado.' );
        }

        $conta = new Conta(
            0,
            htmlspecialchars( $dados[ 'descricao' ] ),
            htmlspecialchars( $dados[ 'valor' ] )
        );

        $problemas = $conta->validar();
        if ( count( $problemas ) > 0 ) {
            throw new DominioException( implode( ' ', $problemas ) );
        }

        $this->repositorio->adicionar( $conta );
    }

    function removerConta($url) {

        $pedacoURL = explode('/', $url);
        $ultimoIndice = count($pedacoURL) - 1;
        $id = $pedacoURL[$ultimoIndice];

        //$id = htmlspecialchars($id);
        
        if (!isset($id)) {
            throw new DominioException('ID da conta não fornecido.');
        }
    
        $conta = $this->repositorio->obterPorId($id);
        if ($conta === null) {
            throw new DominioException('Conta não encontrada.');
        }
    
        // Remove a conta do repositório
        $this->repositorio->remover($id);
    }
    

    function atualizarConta($dados) {
        
        if (!isset($dados['id'])) {
            throw new DominioException('ID não encontrado.');
        }

        if (!isset($dados['descricao'])) {
            throw new DominioException('Descrição não encontrada.');
        }

        if (!isset($dados['valor'])) {
            throw new DominioException('Valor não encontrado.');
        }

        $conta = new Conta(
            htmlspecialchars($dados['id']),
            htmlspecialchars($dados['descricao']),
            htmlspecialchars($dados['valor'])
        );

        $problemas = $conta->validar();
        if (count($problemas) > 0) {
            throw new DominioException(implode(' ', $problemas));
        }

        $this->repositorio->atualizar($conta);
    }
}

?>