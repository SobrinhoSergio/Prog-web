<?php

class Produto {
    // Propriedades e métodos existentes...

    // Variável estática para contar as instâncias da classe
    private static $instanciaCount = 0;

    // Método construtor
    public function __construct($descricao, $estoque, $markup, $precoCompra) {
        // Resto do construtor...
        
        // Incrementar a contagem de instâncias
        self::$instanciaCount++;
    }

    // Método estático para obter a contagem de instâncias
    public static function instancias() {
        return self::$instanciaCount;
    }
}

// Exemplo de uso da classe Produto
$produto1 = new Produto('Produto A', 100, 10, 50.0);
$produto2 = new Produto('Produto B', 200, 15, 60.0);
$produto3 = new Produto('Produto C', 150, 12, 55.0);

// Obter a contagem de instâncias usando o método estático
$quantidadeInstancias = Produto::instancias();

// Exibir a contagem de instâncias
echo "Quantidade de instâncias de Produto: $quantidadeInstancias";




class ProdutoTributado extends Produto {
    private $imposto;

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

    // Sobrescrever o método precoVenda() para incluir o cálculo do preço com imposto
    final public function precoVenda() {
        $precoSemImposto = parent::precoVenda();
        $precoComImposto = $precoSemImposto + ($precoSemImposto * ($this->imposto / 100));
        return $precoComImposto;
    }
}

// Exemplo de uso da classe ProdutoTributado
$produtoTributado = new ProdutoTributado('Produto D', 80, 20, 70.0, 10);
$precoVendaComImposto = $produtoTributado->precoVenda();

echo "Descrição: " . $produtoTributado->getDescricao() . "<br>";
echo "Preço de Venda com Imposto: $precoVendaComImposto";
