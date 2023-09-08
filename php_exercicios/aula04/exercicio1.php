<?php
//1)crie um programa que leia do console os dados de um produto, quando ele adicionar a opção 1 de um menu. A opção 2 deve
//listar os dados de todos os produtos cadastrados. A opção 3 deve sair do progroma.
//Um produto deve possuir descrição, estoque e preço. Crie uma classe para representa-lo, com um constrututor que
//receba os dados

class Produto{
    private $descricao = '';
    private $estoque = 0;
    private $preco = 0.0;

    public function __construct($descricao, $estoque, $preco){
        $this->setDescricao($descricao);
        $this->setEstoque($estoque);
        $this->setPreco($preco);
    }
//get and set
    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function setEstoque($estoque){
        $this->estoque = $estoque;
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

$produtos = [];

function cadastrarProduto(array &$produtos){
    echo 'Informe a descricao do produto: ';
    $descricao = readline('');
    echo 'Informe o estoque do produto: ';
    $estoque = readline('');
    echo 'Informe o preco do produto: ';
    $preco = readline('');
    
    $produto = new Produto($descricao,$estoque,$preco);
    array_push($produtos, $produto);
}

function listarProdutos(array $produtos){
    foreach($produtos as $produto){
        echo 'Descrição: ', $produto->getDescricao(), ' - ', 'Estoque: ', $produto->getEstoque(), ' - ', 
        'Preco: ', $produto->getPreco(), PHP_EOL;
    }
}

function exibirMenu(){
    echo "Escolha uma opcao: \n";
    echo "1 - Cadastrar Produto\n"; 
    echo "2 - Listar Produtos\n";
    echo "3 - Sair\n";
}

do{
    exibirMenu();
    $opcao = readline("");
    switch($opcao){
        case '1':
            cadastrarProduto($produtos);
        break;
        case '2':
            listarProdutos($produtos);
        break;
    }
} while($opcao != '3')

?>