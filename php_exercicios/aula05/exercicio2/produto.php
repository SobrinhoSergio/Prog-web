<?php
//1) criar classe Produto (codigo, descrição, estoque e preço) pertencente ao namespace Acme. Coloque-a no arquivo 'produto.php'
//O estoque não deve ser inferior a zero
//Em caso de ser atribuido para um valor negativo uma exceção deve ser lençada

    namespace Acme;
    
    class Produto {
        private $codigo = 0;
        private $descricao = '';
        private $estoque = 0;
        private $preco = 0.0;

        public function __construct($codigo, $descricao, $estoque, $preco){
            $this->setCodigo($codigo);
            $this->setDescricao($descricao);
            $this->setEstoque($estoque);
            $this->setPreco($preco);
        }

        public function setCodigo($codigo){
            $this->codigo = $codigo;
        }

        public function getCodigo(){
            return $this->codigo;
        }

        public function setDescricao($descricao){
            $this->descricao = $descricao;
        }

        public function getDescricao(){
            return $this->descricao;
        }

        public function setEstoque($estoque){
            if($estoque <= 0){
                throw new \Exception('O estoque nao deve ser inferior a zero');
            }
            return $this->estoque = $estoque;
        }

        public function getEstoque(){
            return $this->estoque;
        }

        public function setPreco($preco){
            $this->preco = $preco;
        }

        public function getPreco(){
            return $this->preco;
        }
    }



?>