<?php
class Categoria{
    private $id = 0;
    private $nome = '';

function __construct($id, $nome){
    $this->id = $id;
    $this->nome = $nome;
}

    function getNome(){
        return $this->nome;
    }

    function getId(){
        return $this->id;
    }

    function setNome(string $nome){
        $this->nome = $nome;
    }
}
?>