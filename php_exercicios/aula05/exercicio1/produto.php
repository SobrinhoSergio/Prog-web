<?php
//1) criar classe Produto (codigo, descrição, estoque e preço) pertencente ao namespace Acme. Coloque-a no arquivo 'produto.php'
//O estoque não deve ser inferior a zero
//Em caso de ser atribuido para um valor negativo uma exceção deve ser lençada

    namespace Acme;
    
    class Produto {
        public $codigo = 0;
        public $descricao = '';
        private $estoque = 0;
        public $preco = 0.0;

        public function setEstoque($estoque){
            if($estoque <= 0){
                throw new \Exception('O estoque nao deve ser inferior a zero');
            }
            return $this->estoque = $estoque;
                
        }

        public function getEstoque(){
            return $this->estoque;
        }
    }



?>