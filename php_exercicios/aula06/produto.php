<?php
 class Produto{
  public $id = 0;
  public $codigo = '';
  public $descricao = '';
  public $estoque = '';
  public $preco = 0.00;

  public function __construct(
   $codigo = '',
   $descricao = '',
   $estoque = '',
   $preco = 0.00){
     $this->codigo = $codigo;
     $this->descricao = $descricao;
     $this->estoque = $estoque;
     $this->preco = $preco;
   }
 }

?>