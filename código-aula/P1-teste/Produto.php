<?php

class Produto{
    public $id = 0;
    public $descricao = '';
    public $preco = 0.00;
    public $quantidade = 0;

    public function __construct($id = 0, $descricao = '', $preco = 0.00, $quantidade = 0){
       $this->id = $id;
       $this->descricao = $descricao;
       $this->preco = $preco; 
       $this->quantidade = $quantidade;
    }
}