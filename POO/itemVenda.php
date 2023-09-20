<?php

require_once 'produto.php';

/* Em um arquivo ItemVenda, crie uma classe que possua uma instância de Produto e um atributo "quantidade, que represente a quantidade vendida. Nela deve haver o método subtotal(), que retorne o preço de venda do produto, multiplicado pela quantidade. A classe deve ter um construtor que inicialize os atrubutos*/

class ItemVenda {
    private $produto = null;
    private $quantidade = 0;

    public function __construct(Produto $produto, $quantidade) {
        $this->setProduto($produto);
        $this->setQuantidade($quantidade);
    }

    public function subtotal() {
        $precoVenda = $this->getProduto()->precoVenda();
        return $precoVenda * $this->getQuantidade();
    }

    public function getProduto() {
        return $this->produto;
    }

    public function getQuantidade() {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    public function setProduto($produto) {
        $this->produto = $produto;
    }
}

$produto = new Produto('Produto E', 50, 18, 80.0);
$itemVenda = new ItemVenda($produto, 3);

$subtotal = $itemVenda->subtotal();

echo "Produto: " . $itemVenda->getProduto()->getDescricao() . "<br>";
echo "Quantidade: " . $itemVenda->getQuantidade() . "<br>";
echo "Subtotal: $subtotal";

/* Crie a classe Venda, em seu próprio arquivo, com os métodos adicionarItem(ItemVenda $item), removerItemNaPosicao($posicao) get
