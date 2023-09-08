<?php
//1)crie um programa que leia do console os dados de um produto, quando ele adicionar a opção 1 de um menu. A opção 2 deve
//listar os dados de todos os produtos cadastrados. A opção 3 deve sair do progroma.
//Um produto deve possuir descrição, estoque e preço. Crie uma classe para representa-lo, com um constrututor que
//receba os dados

/**2) Crie validações para os produtos, a fim de evitar que os mesmos fiquem em um estado incorreto. Um produto é valido se:
*a)Sua descrição tiver de 2 a 100 caracteres;
*b)Seu estoque for um número inteiro natural(>=0);
*c)Seu preço for um número com valor de no mínimo dez reais(10.00).
*Quando qualque dado estiver incorreto, faça com que seja impressa uma frase explicando ao usuário o motivo
*/

/**3) Adicione ao cadastro do produto um pergunta (s/n, sendo 'S' para sim e 'n' para não) de se o produto é taxado.
 *Se o produto for taxado, o precentual do imposto deve ser informado e atribuido ao produto. Para diferenciar um produto  
 * comum de um taxado, crie uma classe ProdutoTaxado que estenda Produto e tenha imposto.
 * O imposto (% deve estar entre 0 e 50)
 */

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
        if(mb_strlen($descricao) >= 2 && mb_strlen($descricao) <= 100){
            $this->descricao = $descricao;
        }
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function setEstoque($estoque){
        if(is_numeric($estoque) && $estoque >= 0){
            $this->estoque = $estoque;
        }
    }

    public function getEstoque(){
        return $this->estoque;
    }

    public function setPreco($preco){
        if(is_numeric($preco) && $preco >= 10.0){
            $this->preco = $preco;
        }
    }

    public function getPreco(){
        return $this->preco;
    }

    public function validacao(){
        if($this->getDescricao() === ''){
            echo 'A descricao de um produto deve ter entre 2 e 100 caracteres. Tente novamente', PHP_EOL;
            return false;
        }
        else if($this->getEstoque() === 0){
            echo 'O estoque deve ser um numero inteiro maior ou igual a 0. Tente novamente', PHP_EOL;
            return false;
        }
        else if($this->getPreco() === 0.0){
            echo 'O preco deve ser um valor acima de R$10,00. Tente novamente', PHP_EOL;
            return false;
        }
        else{
            return true;
        }
    }


}

class ProdutoTaxado extends Produto{
    private $imposto = 0;

    public function getImposto(){
        return $this->imposto;
    }

    public function setImposto($imposto){
        if($imposto >= 0 && $imposto<= 50){
            $this->imposto = $imposto;
        }
    }

    public function setPreco($preco){
        $total = ($preco * ($this->imposto/100+1));
        parent::setPreco($total);
    }

    public function __construct($descricao, $estoque, $preco, $imposto){
         parent::__construct($descricao, $estoque, $preco);
         $this->setImposto($imposto);
         $this->setPreco($preco);
    }

    public function validacao(){
        parent::validacao();
        if($this->imposto == 0){
            echo 'O imposto deve ser um valor entre 0 e 50%', PHP_EOL;
            return false;
        }
        else {
            return true;
        }
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
    echo 'O produto possui imposto? (S/N) S - para Sim ou N - para Não', PHP_EOL;
    $resposta = readline('');
    
    if($resposta === 'n' || $resposta === 'N'){
        $produto = new Produto($descricao,$estoque,$preco);
        if($produto->validacao()){
            array_push($produtos, $produto);
            echo 'Produto salvo com sucesso!', PHP_EOL;
        }   
    }
    else if($resposta === 'S' || $resposta === 's'){
        echo 'Informe o valor do tributo em porcentagem: ', PHP_EOL;
        $imposto = readline('');
        $produto = new ProdutoTaxado($descricao, $estoque, $preco, $imposto);
        if($produto->validacao()){
            array_push($produtos,$produto);
            echo 'Produto salvo com sucesso!', PHP_EOL;
        }
    }
    else{
        echo 'Resposta Invalida';
    }
    
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