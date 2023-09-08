<?php
    require_once 'produto.php';
    use Acme\Produto;

    $p = new Produto();
    $p->codigo = '123';
    $p->descricao = 'produto 1';
    $p->preco = '12.5';
    try{
        $p->setEstoque(0);
    }catch(Exception $e){
        echo $e->getMessage();
    }
?>