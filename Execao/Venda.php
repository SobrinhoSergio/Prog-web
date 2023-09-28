
<?php
require_once 'ItemVenda.php';
require_once 'VendaException.php';


use \excecoes\VendaException;

class Venda {

    private $itens = [];

    public function adicionarItem( ItemVenda $item ) {
        if(!$item){
            throw new VendaException("O item não deve ser nullo");
        }
       
        array_push( $this->itens, $item );
        // $this->itens []= $item;
       
      
    }
    

    public function removerItemNaPosicao( $posicao ) {

        if($posicao<0){
            throw new VendaException("A posição não deve ser negativa");
        }

       
        unset( $this->itens[ $posicao ] );
      
      
    }

    public function getItens() {
        return $this->itens;
    }

    public function total() {
        $resultado = 0;
        foreach ( $this->itens as $item ) {
            $resultado += $item->subtotal();
        }
        return $resultado;
    }

}


$p = new Produto( 'Guaraná', 10, 10.00, 10.00 );
$iv = new ItemVenda( 5, $p );
echo $iv->subtotal(), PHP_EOL; // 55

$p2 = new Produto( 'Cerveja', 5, 20.00, 10.00 );
$iv2 = new ItemVenda( 1, $p2 );
echo $iv2->subtotal(), PHP_EOL; // 22

$venda = new Venda();
$venda->adicionarItem( $iv );
$venda->adicionarItem( $iv2 );
echo 'Total: ', $venda->total();