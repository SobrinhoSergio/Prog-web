<?php

require_once 'produto.php';

final class ProdutoTributado extends Produto{
    private $imposto = 0;

    public function __construct($descricao = '', $estoque = 0, $markup = 0, $precoCompra = 0, $imposto = 0) {
        parent::__construct($descricao, $estoque, $markup, $precoCompra);
        $this->setImposto($imposto);
    }
    
    public function getImposto() {
        return $this->imposto;
    }

    public function setImposto($imposto) {
        $this->imposto = $imposto;
    }

    public function precoVenda() {
        $precoSemImposto = parent::precoVenda();
        $precoComImposto = $precoSemImposto + ($precoSemImposto * ($this->imposto / 100));
        return $precoComImposto;
    }


}

$produtoTributado = new ProdutoTributado('Produto D', 80, 20, 70.0, 10);
$precoVendaComImposto = $produtoTributado->precoVenda();