<?php
require_once 'Conta.php';
require_once 'RepositorioConta.php';
require_once 'DominioException.php';

class GestorConta{

    private $repositorio;

    function __construct(RepositorioConta $repositorio){
        $this->repositorio = $repositorio;
    }

    function adicionarConta($dados){

        if(!isset($dados['descricao'])){
            throw new DominoException("Descrição não encontrada.");
        }

        if(!isset($dados['valor'])){
            throw new DominioException("Valor não encontrado.");
        }

        $conta = new Conta(
            0,
            htmlspecialchars($dados['descricao']),
            htmlspecialchars($dados['valor'])
        );

        $problemas = $conta->validar();
        if(count($problemas)>0){
            throw new DominioExceprion(implode('', $problemas));
        }

        $this->repositorio->adicionarConta($conta);

    }

    function removerConta($id){

        $id = htmlspcialchars($id);

        if(!isset($id)){
            throw new DominioException('ID da conta não fornecido.');
        }

        $conta = $this->repositorio->obterId($id);
        if($conta === null){
            die("Conta não encontrada.");
        }

        $repositorio->removerConta($id);

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
            throw new DominioException(implode('', $problemas));
        }

        $this->repositorio->atualizarConta($conta);
    }


}