<?php

require_once "Produto.php";

class TelaProduto {
    public function obterProduto() {
        echo "Digite o código do produto: ";
        $codigo = readline();
        echo "Digite a descrição do produto: ";
        $descricao = readline();
        echo "Digite o estoque do produto: ";
        $estoque = readline();
        echo "Digite o preço do produto: ";
        $preco = readline();

        return new Produto($codigo, $descricao, $estoque, $preco);
    }

    public function mostrarProdutos($produtos) {
        foreach ($produtos as $produto) {
            echo "Código: " . $produto->codigo . ", Descrição: " . $produto->descricao . ", Estoque: " . $produto->estoque . ", Preço: " . $produto->preco . "\n";
        }
    }

    public function menu() {
        echo "MENU\n";
        echo "0) Sair\n";
        echo "1) Listar\n";
        echo "2) Cadastrar\n";

        $opcao = readline("Escolha uma opção: ");
        return $opcao;
    }
}

/*$telaProduto = new TelaProduto();
$produto = $telaProduto->obterProduto();
$telaProduto->mostrarProdutos([$produto]);
//$p = new Produto([$produto]);
//var_dump($p->validar());
$opcao = $telaProduto->menu();
