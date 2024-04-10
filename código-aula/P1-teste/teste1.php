<?php

class ContaBancaria{
    private $id;
    private $nome;
    private $cpf;
    private $saldo;

    function __construct($id, $nome, $cpf, $saldo){
        $this->id = $id;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->saldo = $saldo;
    }

    function getNome(){
        return $this->nome;
    }

    function setNome($nome){
        $this->nome = $nome;
    }

    function validar(){

        $mensagem = [];

        if(!is_numeric($this->getId()) || getId<=0){
            array_push($mensagem, 'O Id deve ser um número inteiro positivo');
        }

        $tamNome = mb_strlen(getNome());

        if($tamNome < 2 || $tamNome > 100){
            array_push($mensagem, 'Nome inválido!');
        }

    }

    


}