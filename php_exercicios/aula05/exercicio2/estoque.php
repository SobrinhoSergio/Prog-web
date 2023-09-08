<?php
//Em um arquivo 'estoque.php', crie um pequena aplicação para gerir o estoque de produtos. Para isto, crie um array de 
//objetos de Produtos com os rodutos da loja Acme. Os produtos devem ser instanciados como atributos e uma quantidade
//superior a zero. Então crie um menu que permita 1 - Aumentar o estoque do produto. 2 - Reduzir o estoque do produto
// 3 - Sair. Ao escolher a opção de aumentar o usuario deve informar o codigo do produto desejado.Ao escolher resuzir
//ele deve informar o codigo e a quantidade a ser reduzida
    require_once 'produto.php';
    use Acme\Produto;

    //criando o array de produtos
    $p1 = new Produto('1','Produto 1', 50, 12.00);
    $p2 = new Produto('2','Produto 2', 500, 25.30);
    $p3 = new Produto('3','Produto 3', 90, 10.00);
    $produtos = [$p1, $p2, $p3];

    function exibirMenu(){
        echo "Escolha uma opcao: \n";
        echo "1 - Aumentar o estoque do produto\n"; 
        echo "2 - Reduzir o estoque do produto\n";
        echo "3 - Listar produtos\n";
        echo "4 - Sair\n";
    }

    function recuperarProduto($produtos){
        echo 'Informe o codigo do produto: ';
        $codigo = readline('');
        foreach($produtos as $produto){
            if($produto->getCodigo() == $codigo){
                return $produto;
            }
        }
    }

    function aumentarEstoque($produtos){
        $produto = recuperarProduto($produtos);
        if(isset($produto)){
            echo 'Valor de aumento: ';
            $valor = readline('');
            if($valor > 0){
                $produto->setEstoque($produto->getEstoque() + $valor); 
            } else{echo 'O valor deve ser maior do que zero.', PHP_EOL;}
        }   
        else {
            echo 'Nao existe um produto cadastrado para esse codigo';
        }     
    }

    function reduzirEstoque($produtos){
        $produto = recuperarProduto($produtos);
        if(isset($produto)){
            echo 'Valor a ser reduzido: ';
            $valor = readline('');
            if($valor < $produto->getEstoque()){
                $produto->setEstoque($produto->getEstoque() - $valor); 
            } else{echo 'O estoque nao pode ser zerado.', PHP_EOL;}
        }   
        else {
            echo 'Nao existe um produto cadastrado para esse codigo';
        }
    }

    function listarProdutos(array $produtos){
        foreach($produtos as $produto){
            echo 'Codigo: ', $produto->getCodigo(), ' - ', 'Descicao: ', $produto->getDescricao(), ' - ', 'Estoque: ',
            $produto->getEstoque(), ' - ', 'Preco: ', $produto->getPreco(), PHP_EOL;
        }
    }

    do{
        exibirMenu();
        $opcao = readline("");
        switch($opcao){
            case '1':
                aumentarEstoque($produtos);
            break;
            case '2':
                reduzirEstoque($produtos);
            break;
            case '3':
                listarProdutos($produtos);
            break;
        }
    } while($opcao != '4')


?>