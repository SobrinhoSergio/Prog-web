<?php

class Produto{

    private $descricao;
    private $estoque;
    private $markup;
    private $precoCompra;

    private static $instanciaCount = 0;

    public function __construct( $descricao = '', $estoque = 0, $markup = 0 , $precoCompra = 0){
        $this->setDescricao($descricao);
        $this->setEstoque($estoque);
        $this->setMarkup($markup);
        $this->setPrecoCompra($precoCompra);

        self::$instanciaCount++;

    }

    public static function instancias() {
        return self::$instanciaCount;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getEstoque() {
        return $this->estoque;
    }

    public function setEstoque($estoque) {
        $this->estoque = $estoque;
    }

  
    public function getMarkup() {
        return $this->markup;
    }


    public function setMarkup($markup) {
        $this->markup = $markup;
    }

    public function getPrecoCompra() {
        return $this->precoCompra;
    }

    public function setPrecoCompra($precoCompra) {
        $this->precoCompra = $precoCompra;
    }

    public function precoVenda() {
        $precoVenda = $this->precoCompra + ($this->precoCompra * ($this->markup / 100));
        return $precoVenda;
    }

    public function  precoVenda2() {
         return $this->getPrecoCompra + ($this->getPrecoCompra * ($this->getMarkup / 100));
    }


}

$p1 = new Produto();
$p1->setDescricao('Água');
echo $p1->getDescricao(), PHP_EOL;
$p1->setEstoque(10);
echo $p1->getEstoque(),  PHP_EOL;
$p1->setPrecoCompra(5);
$p1->setMarkup(10);
echo $p1->getPrecoCompra(),  PHP_EOL;
echo $p1->precoVenda();

$produto2 = new Produto('GIRAFAAAAASSSS', 200, 15, 60.0);

echo '----------------------';
echo $produto2->getDescricao(), PHP_EOL;
echo '----------------------';

$produto3 = new Produto('Produto C', 150, 12, 55.0);

$quantidadeInstancias = Produto::instancias();
echo "Quantidade de instâncias de Produto: $quantidadeInstancias";


/* O método precoVenda(), que por padrão retorna o preco, que por padrão retorna o preco de compra adicionado 
do markup. O markup é um valor percentual, 10%.*/

/* Crie um método  estatico instancias() em produtos que retorne quantas vezes a classe foi instanciada*/


/* Crie a classe final "ProdutoTributado" que represente um produto com imposto. Acrescente o atributo "imposto" e sobrescreva precoVenda() acrescentando seu percentual*/
