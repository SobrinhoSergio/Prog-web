<?php
    require_once 'categoria.php';

    class MateriaPrima{
        private $id = 0;
        private $descricao = '';
        private $quantidade = 0;
        private $custo = 0.0;
        private $categoria;

        function __construct($desc,$qtd,$custo,Categoria $cat){
            $this->setDescricao($desc);
            $this->setQuantidade($qtd);
            $this->setCusto($custo);
            $this->setIdCategoria($cat);
        }

        function setDescricao($desc){
            $this->descricao = $desc;
        }

        function getDescricao(){
            return $this->descricao;
        }

        function setQuantidade($qtd){
            $this->quantidade = $qtd;
        }

        function getQuantidade(){
            return $this->quantidade;
        }

        function setCusto($custo){
            $this->custo = $custo;
        }

        function getCusto(){
            return $this->custo;
        }

        function setCategoria($cat){
            $this->categoria = $cat;
        }

        function getCategoria(){
            return $this->categoria;
        }
    }

?>