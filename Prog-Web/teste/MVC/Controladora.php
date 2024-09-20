<?php
require_once 'VisaoConta.php';
require_once 'GestorConta.php';
require_once 'RepositorioContaEmBDR.php';

class ControladoraConta {

    private $visao;
    private $gestor;

    function __construct(){
        $this->visao = new VisaoConta();
        
        $pdo = new PDO(
            'mysql:host=localhost;dbname=p2;charset=utf8',
            'root',
            'senha123',
            [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ]
        );

        $repositorio = new RepositorioContaEmBDR($pdo);
        $this->gestor = new GestorConta($repositorio);
    }

    function cadastrar(){
        $dados = $this->visao->dadosConta();
        try{
            $this->gestor->adicionarConta($dados);
            $this->visao->mostrarCadastradoComSucesso();
        }catch(Exception $e){
            $this->visao->mostrarExecao();
        }
    }

    function remover(){
        $dados = $this->visao->dadosConta();
        try{
            $this->gestor->removerConta($dados);
            $this->visao->mostrarRemovidoComSucesso();
        }catch(Exception $e){
            $this->visao->mostrarExecao();
        }
    }

    function atualizar(){
        $dados = $this->visao->dadosConta();
        try{
            $this->gestor->removerConta($dados);
            $this->visao->mostrarAtualizadoComSucesso();
        }catch(Exception $e){
            $this->visao->mostrarExecao();
        }
    }



}