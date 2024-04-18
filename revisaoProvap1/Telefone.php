<?php

class Telefone{
    private $id;
    private $numero;

    function __construct($id = 0, $numero = ''){
        $this->id = $id;
        $this->numero = $numero;
    }

    function getId(){
        return $this->id;
    }

    function setId($id){
        $this->id = $id;
    }

    function getTelefone(){
        return $this->telefone;
    }

    function setTelefone($telefone){
        $this->telefone = $telefone;
    }

    function validar(){
        $mensagem = [];

        if(!is_numeric($this->getId()) ||  $this->getId() <= 0){
            array_push($mensagem, "O Id deve ser um número positivo.");
        }

        $tamanhoNumero = mb_strlen($this->getNumero());
        
        if(!is_numeric($this->getNumero()) || $tamanhoNumero < 11){
            array_push($mensagem, "O número deve ser um número com 11 caracteres.");
        }

        return $mensagem;
    }
}